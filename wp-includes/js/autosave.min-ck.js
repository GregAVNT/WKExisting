function autosave_parse_response(e){var t,n,r=wpAjax.parseAjaxResponse(e,"autosave");return r&&r.responses&&r.responses.length&&(r.responses[0].supplemental&&(n=r.responses[0].supplemental,jQuery.each(n,function(e,t){e.match(/^replace-/)&&jQuery("#"+e.replace("replace-","")).val(t)})),r.errors||((t=parseInt(r.responses[0].id,10))&&autosave_update_slug(t),r.responses[0].data&&jQuery(".autosave-message").text(r.responses[0].data))),r}function autosave_saved(e){blockSave=!1,autosave_parse_response(e),autosave_enable_buttons()}function autosave_saved_new(e){blockSave=!1;var t,n=autosave_parse_response(e);n&&n.responses.length&&!n.errors?(t=parseInt(n.responses[0].id,10),t&&(notSaved=!1,jQuery("#auto_draft").val("0")),autosave_enable_buttons(),autosaveDelayPreview&&(autosaveDelayPreview=!1,doPreview())):autosave_enable_buttons()}function autosave_update_slug(e){"undefined"!=makeSlugeditClickable&&jQuery.isFunction(makeSlugeditClickable)&&!jQuery("#edit-slug-box > *").size()&&jQuery.post(ajaxurl,{action:"sample-permalink",post_id:e,new_title:fullscreen&&fullscreen.settings.visible?jQuery("#wp-fullscreen-title").val():jQuery("#title").val(),samplepermalinknonce:jQuery("#samplepermalinknonce").val()},function(e){if("-1"!==e){var t=jQuery("#edit-slug-box");t.html(e),t.hasClass("hidden")&&t.fadeIn("fast",function(){t.removeClass("hidden")}),makeSlugeditClickable()}})}function autosave_loading(){jQuery(".autosave-message").html(autosaveL10n.savingText)}function autosave_enable_buttons(){jQuery(document).trigger("autosave-enable-buttons"),wp.heartbeat&&wp.heartbeat.hasConnectionError()||setTimeout(function(){var e=jQuery("#submitpost");e.find(":button, :submit").removeAttr("disabled"),e.find(".spinner").hide()},500)}function autosave_disable_buttons(){jQuery(document).trigger("autosave-disable-buttons"),jQuery("#submitpost").find(":button, :submit").prop("disabled",!0),setTimeout(autosave_enable_buttons,5e3)}function delayed_autosave(){setTimeout(function(){blockSave||autosave()},200)}var autosave,autosavePeriodical,fullscreen,doPreview,autosaveLast="",autosaveDelayPreview=!1,notSaved=!0,blockSave=!1,autosaveLockRelease=!0;jQuery(document).ready(function(e){autosaveLast=e("#wp-content-wrap").hasClass("tmce-active")&&"undefined"!=typeof switchEditors?wp.autosave.getCompareString({post_title:e("#title").val()||"",content:switchEditors.pre_wpautop(e("#content").val())||"",excerpt:e("#excerpt").val()||""}):wp.autosave.getCompareString(),autosavePeriodical=e.schedule({time:1e3*autosaveL10n.autosaveInterval,func:function(){autosave()},repeat:!0,protect:!0}),e("#post").submit(function(){e.cancel(autosavePeriodical),autosaveLockRelease=!1}),e('input[type="submit"], a.submitdelete',"#submitpost").click(function(){blockSave=!0,window.onbeforeunload=null,e(":button, :submit","#submitpost").each(function(){var t=e(this);t.hasClass("button-primary")?t.addClass("button-primary-disabled"):t.addClass("button-disabled")}),"publish"==e(this).attr("id")?e("#major-publishing-actions .spinner").show():e("#minor-publishing .spinner").show()}),window.onbeforeunload=function(){var t,n="undefined"!=typeof tinymce?tinymce.activeEditor:!1;if(n&&!n.isHidden()){if(n.isDirty())return autosaveL10n.saveAlert}else if(t=fullscreen&&fullscreen.settings.visible?wp.autosave.getCompareString({post_title:e("#wp-fullscreen-title").val()||"",content:e("#wp_mce_fullscreen").val()||"",excerpt:e("#excerpt").val()||""}):wp.autosave.getCompareString(),t!=autosaveLast)return autosaveL10n.saveAlert},e(window).unload(function(t){autosaveLockRelease&&(t.target&&"#document"!=t.target.nodeName||e.ajax({type:"POST",url:ajaxurl,async:!1,data:{action:"wp-remove-post-lock",_wpnonce:e("#_wpnonce").val(),post_ID:e("#post_ID").val(),active_post_lock:e("#active_post_lock").val()}}))}),e("#post-preview").click(function(){return"1"==e("#auto_draft").val()&&notSaved?(autosaveDelayPreview=!0,autosave(),!1):(doPreview(),!1)}),doPreview=function(){e("input#wp-preview").val("dopreview"),e("form#post").attr("target","wp-preview").submit().attr("target","");var t=navigator.userAgent.toLowerCase();-1!=t.indexOf("safari")&&-1==t.indexOf("chrome")&&e("form#post").attr("action",function(e,t){return t+"?t="+(new Date).getTime()}),e("input#wp-preview").val("")},e("#title").on("keydown.editor-focus",function(t){var n;9==t.which&&(t.ctrlKey||t.altKey||t.shiftKey||("undefined"!=typeof tinymce&&(n=tinymce.get("content")),n&&!n.isHidden()?e(this).one("keyup",function(){e("#content_tbl td.mceToolbar > a").focus()}):e("#content").focus(),t.preventDefault()))}),"1"==e("#auto_draft").val()&&e("#title").blur(function(){this.value&&"1"==e("#auto_draft").val()&&delayed_autosave()}),e(document).on("heartbeat-connection-lost.autosave",function(t,n,r){if("timeout"===n||503==r){var i=e("#lost-connection-notice");wp.autosave.local.hasStorage||i.find(".hide-if-no-sessionstorage").hide(),i.show(),autosave_disable_buttons()}}).on("heartbeat-connection-restored.autosave",function(){e("#lost-connection-notice").hide(),autosave_enable_buttons()})}),autosave=function(){var e,t,n=wp.autosave.getPostData();return blockSave=!0,n.autosave?"block"==jQuery("#TB_window").css("display")?!1:(e=wp.autosave.getCompareString(n),e==autosaveLast?!1:(autosaveLast=e,jQuery(document).triggerHandler("wpcountwords",[n.content]),autosave_disable_buttons(),t="1"==n.auto_draft?autosave_saved_new:autosave_saved,jQuery.ajax({data:n,beforeSend:autosave_loading,type:"POST",url:ajaxurl,success:t}),!0)):!1},window.wp=window.wp||{},wp.autosave=wp.autosave||{},function(e){wp.autosave.getPostData=function(){var t,n,r="undefined"!=typeof tinymce?tinymce.activeEditor:null,i=[],s={action:"autosave",autosave:!0,post_id:e("#post_ID").val()||0,autosavenonce:e("#autosavenonce").val()||"",post_type:e("#post_type").val()||"",post_author:e("#post_author").val()||"",excerpt:e("#excerpt").val()||""};if(r&&!r.isHidden()){if(r.plugins.spellchecker&&r.plugins.spellchecker.active)return s.autosave=!1,s;"mce_fullscreen"==r.id&&tinymce.get("content").setContent(r.getContent({format:"raw"}),{format:"raw"}),tinymce.triggerSave()}return"undefined"!=typeof fullscreen&&fullscreen.settings.visible?(s.post_title=e("#wp-fullscreen-title").val()||"",s.content=e("#wp_mce_fullscreen").val()||""):(s.post_title=e("#title").val()||"",s.content=e("#content").val()||""),e('input[id^="in-category-"]:checked').each(function(){i.push(this.value)}),s.catslist=i.join(","),(t=e("#post_name").val())&&(s.post_name=t),(n=e("#parent_id").val())&&(s.parent_id=n),e("#comment_status").prop("checked")&&(s.comment_status="open"),e("#ping_status").prop("checked")&&(s.ping_status="open"),"1"==e("#auto_draft").val()&&(s.auto_draft="1"),s},wp.autosave.getCompareString=function(t){return"object"==typeof t?(t.post_title||"")+"::"+(t.content||"")+"::"+(t.excerpt||""):(e("#title").val()||"")+"::"+(e("#content").val()||"")+"::"+(e("#excerpt").val()||"")},wp.autosave.local={lastSavedData:"",blog_id:0,hasStorage:!1,checkStorage:function(){var e=Math.random(),t=!1;try{sessionStorage.setItem("wp-test",e),t=sessionStorage.getItem("wp-test")==e,sessionStorage.removeItem("wp-test")}catch(n){}return this.hasStorage=t,t},getStorage:function(){var e=!1;return this.hasStorage&&this.blog_id&&(e=sessionStorage.getItem("wp-autosave-"+this.blog_id),e=e?JSON.parse(e):{}),e},setStorage:function(e){var t;return this.hasStorage&&this.blog_id?(t="wp-autosave-"+this.blog_id,sessionStorage.setItem(t,JSON.stringify(e)),null!==sessionStorage.getItem(t)):!1},getData:function(){var t=this.getStorage(),n=e("#post_ID").val();return t&&n?t["post_"+n]||!1:!1},setData:function(t){var n=this.getStorage(),r=e("#post_ID").val();if(!n||!r)return!1;if(t)n["post_"+r]=t;else{if(!n.hasOwnProperty("post_"+r))return!1;delete n["post_"+r]}return this.setStorage(n)},save:function(t){var n,r,i=!1;return t?(n=this.getData()||{},e.extend(n,t),n.autosave=!0):n=wp.autosave.getPostData(),n.autosave?(r=wp.autosave.getCompareString(n),r==this.lastSavedData?!1:(n.save_time=(new Date).getTime(),n.status=e("#post_status").val()||"",i=this.setData(n),i&&(this.lastSavedData=r),i)):!1},init:function(t){var n=this;this.checkStorage()&&(e("#content").length||e("#excerpt").length)&&(t&&e.extend(this,t),this.blog_id||(this.blog_id="undefined"!=typeof window.autosaveL10n?window.autosaveL10n.blog_id:0),e(document).ready(function(){n.run()}))},run:function(){var t=this;this.checkPost(),this.schedule=e.schedule({time:15e3,func:function(){wp.autosave.local.save()},repeat:!0,protect:!0}),e("form#post").on("submit.autosave-local",function(){var n="undefined"!=typeof tinymce&&tinymce.get("content"),r=e("#post_ID").val()||0;n&&!n.isHidden()?n.onSubmit.add(function(){wp.autosave.local.save({post_title:e("#title").val()||"",content:e("#content").val()||"",excerpt:e("#excerpt").val()||""})}):t.save({post_title:e("#title").val()||"",content:e("#content").val()||"",excerpt:e("#excerpt").val()||""}),wpCookies.set("wp-saving-post-"+r,"check")})},compare:function(e,t){function n(e){return e.toString().replace(/[\x20\t\r\n\f]+/g,"")}return n(e||"")==n(t||"")},checkPost:function(){var t,n,r,i,s=this,o=this.getData(),u=e("#post_ID").val()||0,f=wpCookies.get("wp-saving-post-"+u);if(o)return f&&(wpCookies.remove("wp-saving-post-"+u),"saved"==f)?(this.setData(!1),void 0):(e("#has-newer-autosave").length||(t=e("#content").val()||"",n=e("#title").val()||"",r=e("#excerpt").val()||"",e("#wp-content-wrap").hasClass("tmce-active")&&"undefined"!=typeof switchEditors&&(t=switchEditors.pre_wpautop(t)),"check"!=f&&this.compare(t,o.content)&&this.compare(n,o.post_title)&&this.compare(r,o.excerpt)||(this.restore_post_data=o,this.undo_post_data={content:t,post_title:n,excerpt:r},i=e("#local-storage-notice"),e(".wrap h2").first().after(i.addClass("updated").show()),i.on("click",function(t){var n=e(t.target);n.hasClass("restore-backup")?(s.restorePost(s.restore_post_data),n.parent().hide(),e(this).find("p.undo-restore").show()):n.hasClass("undo-restore-backup")&&(s.restorePost(s.undo_post_data),n.parent().hide(),e(this).find("p.local-restore").show()),t.preventDefault()}))),void 0)},restorePost:function(t){var n;return t?(this.lastSavedData=wp.autosave.getCompareString(t),e("#title").val()!=t.post_title&&e("#title").focus().val(t.post_title||""),e("#excerpt").val(t.excerpt||""),n="undefined"!=typeof tinymce&&tinymce.get("content"),n&&!n.isHidden()&&"undefined"!=typeof switchEditors?(n.undoManager.add(),n.setContent(t.content?switchEditors.wpautop(t.content):"")):(e("#content-html").click(),e("#content").val(t.content)),!0):!1}},wp.autosave.local.init()}(jQuery);