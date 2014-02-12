!function(){var e={};tinymce.create("tinymce.plugins.wpEditImage",{url:"",editor:{},init:function(t,n){var r=this;r.url=n,r.editor=t,r._createButtons(),t.addCommand("WP_EditImage",r._editImage),t.onInit.add(function(e){e.dom.events.add(e.getBody(),"mousedown",function(t){var n;"IMG"==t.target.nodeName&&(n=e.dom.getParent(t.target,"div.mceTemp"))&&(tinymce.isGecko?e.selection.select(n):tinymce.isWebKit&&e.dom.events.prevent(t))}),e.dom.events.add(e.getBody(),"keydown",function(t){var n,r,i,s;return 13==t.keyCode&&(n=e.selection.getNode(),r=e.dom.getParent(n,"dl.wp-caption"),r&&(i=e.dom.getParent(r,"div.mceTemp")),i)?(e.dom.events.cancel(t),s=e.dom.create("p",{},"﻿"),e.dom.insertAfter(s,i),e.selection.setCursorLocation(s,0),!1):void 0}),"ontouchstart"in window&&e.dom.events.add(e.getBody(),"touchstart",function(e){r._showButtons(e)})}),t.onMouseUp.add(function(t,n){if(!tinymce.isWebKit&&!tinymce.isOpera){if(e.x&&(n.clientX!=e.x||n.clientY!=e.y)){var r=t.selection.getNode();"IMG"==r.nodeName&&window.setTimeout(function(){var n,i=t.dom.getParent(r,"dl.wp-caption");(r.width!=e.img_w||r.height!=e.img_h)&&(r.className=r.className.replace(/size-[^ "']+/,"")),i&&(n=t.dom.getAttrib(r,"width")||r.width,n=parseInt(n,10),t.dom.setStyle(i,"width",10+n),t.execCommand("mceRepaint"))},100)}e={}}}),t.onMouseDown.add(function(e,t){r._showButtons(t)}),t.onBeforeSetContent.add(function(e,t){t.content=e.wpSetImgCaption(t.content)}),t.onPostProcess.add(function(e,t){t.get&&(t.content=e.wpGetImgCaption(t.content))}),t.wpSetImgCaption=function(e){return r._do_shcode(e)},t.wpGetImgCaption=function(e){return r._get_shcode(e)},t.onBeforeExecCommand.add(function(e,t){var n,r;if("mceInsertContent"==t){if(n=e.dom.getParent(e.selection.getNode(),"div.mceTemp"),!n)return;r=e.dom.create("p"),e.dom.insertAfter(r,n),e.selection.setCursorLocation(r,0)}})},_do_shcode:function(e){return e.replace(/(?:<p>)?\[(?:wp_)?caption([^\]]+)\]([\s\S]+?)\[\/(?:wp_)?caption\](?:<\/p>)?/g,function(e,t,n){var r,i,s,o,u,a,f=tinymce.trim;return r=t.match(/id=['"]([^'"]*)['"] ?/),r&&(t=t.replace(r[0],"")),i=t.match(/align=['"]([^'"]*)['"] ?/),i&&(t=t.replace(i[0],"")),s=t.match(/width=['"]([0-9]*)['"] ?/),s&&(t=t.replace(s[0],"")),n=f(n),a=n.match(/((?:<a [^>]+>)?<img [^>]+>(?:<\/a>)?)([\s\S]*)/i),a&&a[2]?(o=f(a[2]),a=f(a[1])):(o=f(t).replace(/caption=['"]/,"").replace(/['"]$/,""),a=n),r=r&&r[1]?r[1]:"",i=i&&i[1]?i[1]:"alignnone",s=s&&s[1]?s[1]:"",s&&o?(u="mceTemp","aligncenter"==i&&(u+=" mceIEcenter"),s=parseInt(s,10)+10,'<div class="'+u+'"><dl id="'+r+'" class="wp-caption '+i+'" style="width: '+s+'px"><dt class="wp-caption-dt">'+a+'</dt><dd class="wp-caption-dd">'+o+"</dd></dl></div>"):n})},_get_shcode:function(e){return e.replace(/<div (?:id="attachment_|class="mceTemp)[^>]*>([\s\S]+?)<\/div>/g,function(e,t){var n=t.replace(/<dl ([^>]+)>\s*<dt [^>]+>([\s\S]+?)<\/dt>\s*<dd [^>]+>([\s\S]*?)<\/dd>\s*<\/dl>/gi,function(e,t,n,r){var i,s,o;return o=n.match(/width="([0-9]*)"/),o=o&&o[1]?o[1]:"",o&&r?(i=t.match(/id="([^"]*)"/),i=i&&i[1]?i[1]:"",s=t.match(/class="([^"]*)"/),s=s&&s[1]?s[1]:"",s=s.match(/align[a-z]+/)||"alignnone",r=r.replace(/\r\n|\r/g,"\n").replace(/<[a-zA-Z0-9]+( [^<>]+)?>/g,function(e){return e.replace(/[\r\n\t]+/," ")}),r=r.replace(/\s*\n\s*/g,"<br />"),'[caption id="'+i+'" align="'+s+'" width="'+o+'"]'+n+" "+r+"[/caption]"):n});return 0!==n.indexOf("[caption")&&(n=t.replace(/[\s\S]*?((?:<a [^>]+>)?<img [^>]+>(?:<\/a>)?)(<p>[\s\S]*<\/p>)?[\s\S]*/gi,"<p>$1</p>$2")),n})},_createButtons:function(){var e,t,n,r=this,i=tinymce.activeEditor,s=tinymce.DOM;s.get("wp_editbtns")||(n=window.devicePixelRatio&&window.devicePixelRatio>1||window.matchMedia&&window.matchMedia("(min-resolution:130dpi)").matches,s.add(document.body,"div",{id:"wp_editbtns",style:"display:none;"}),e=s.add("wp_editbtns","img",{src:n?r.url+"/img/image-2x.png":r.url+"/img/image.png",id:"wp_editimgbtn",width:"24",height:"24",title:i.getLang("wpeditimage.edit_img")}),tinymce.dom.Event.add(e,"mousedown",function(){r._editImage(),i.plugins.wordpress._hideButtons()}),t=s.add("wp_editbtns","img",{src:n?r.url+"/img/delete-2x.png":r.url+"/img/delete.png",id:"wp_delimgbtn",width:"24",height:"24",title:i.getLang("wpeditimage.del_img")}),tinymce.dom.Event.add(t,"mousedown",function(){var e,t=tinymce.activeEditor,n=t.selection.getNode();return"IMG"==n.nodeName&&-1==t.dom.getAttrib(n,"class").indexOf("mceItem")?((e=t.dom.getParent(n,"div"))&&t.dom.hasClass(e,"mceTemp")?t.dom.remove(e):("A"==n.parentNode.nodeName&&1==n.parentNode.childNodes.length&&(n=n.parentNode),"P"==n.parentNode.nodeName&&1==n.parentNode.childNodes.length&&(n=n.parentNode),t.dom.remove(n)),t.execCommand("mceRepaint"),!1):(t.plugins.wordpress._hideButtons(),void 0)}))},_editImage:function(){var e,t,n,r=tinymce.activeEditor,i=this.url,s=r.selection.getNode(),o=s.className;-1==o.indexOf("mceItem")&&-1==o.indexOf("wpGallery")&&"IMG"==s.nodeName&&(e=tinymce.DOM.getViewPort(),t=680<e.h-70?680:e.h-70,n=650<e.w?650:e.w,r.windowManager.open({file:i+"/editimage.html",width:n+"px",height:t+"px",inline:!0}))},_showButtons:function(t){var n=this.editor,r=t.target;if("IMG"!=r.nodeName){if(!r.firstChild||"IMG"!=r.firstChild.nodeName||1!=r.childNodes.length)return n.plugins.wordpress._hideButtons(),void 0;r=r.firstChild}-1==n.dom.getAttrib(r,"class").indexOf("mceItem")&&(e={x:t.clientX,y:t.clientY,img_w:r.clientWidth,img_h:r.clientHeight},"touchstart"==t.type&&(n.selection.select(r),n.dom.events.cancel(t)),n.plugins.wordpress._hideButtons(),n.plugins.wordpress._showButtons(r,"wp_editbtns"))},getInfo:function(){return{longname:"Edit Image",author:"WordPress",authorurl:"http://wordpress.org",infourl:"",version:"1.0"}}}),tinymce.PluginManager.add("wpeditimage",tinymce.plugins.wpEditImage)}();