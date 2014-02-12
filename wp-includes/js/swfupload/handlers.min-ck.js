function fileDialogStart(){jQuery("#media-upload-error").empty()}function fileQueued(e){jQuery(".media-blank").remove();if(jQuery("form.type-form #media-items").children().length==1&&jQuery(".hidden","#media-items").length>0){jQuery(".describe-toggle-on").show();jQuery(".describe-toggle-off").hide();jQuery(".slidetoggle").slideUp(200).siblings().removeClass("hidden")}jQuery('<div class="media-item">').attr("id","media-item-"+e.id).addClass("child-of-"+post_id).append('<div class="progress"><div class="bar"></div></div>',jQuery('<div class="filename original"><span class="percent"></span>').text(" "+e.name)).appendTo(jQuery("#media-items"));jQuery(".progress","#media-item-"+e.id).show();jQuery("#insert-gallery").prop("disabled",!0);jQuery("#cancel-upload").prop("disabled",!1)}function uploadStart(e){try{typeof topWin.tb_remove!="undefined"&&topWin.jQuery("#TB_overlay").unbind("click",topWin.tb_remove)}catch(t){}return!0}function uploadProgress(e,t,n){var r=jQuery("#media-items").width()-2,i=jQuery("#media-item-"+e.id);jQuery(".bar",i).width(r*t/n);jQuery(".percent",i).html(Math.ceil(t/n*100)+"%");t==n&&jQuery(".bar",i).html('<strong class="crunching">'+swfuploadL10n.crunching+"</strong>")}function prepareMediaItem(e,t){var n=typeof shortform=="undefined"?1:2,r=jQuery("#media-item-"+e.id);jQuery(".bar",r).remove();jQuery(".progress",r).hide();try{typeof topWin.tb_remove!="undefined"&&topWin.jQuery("#TB_overlay").click(topWin.tb_remove)}catch(i){}if(isNaN(t)||!t){r.append(t);prepareMediaItemInit(e)}else r.load("async-upload.php",{attachment_id:t,fetch:n},function(){prepareMediaItemInit(e);updateMediaForm()})}function prepareMediaItemInit(e){var t=jQuery("#media-item-"+e.id);jQuery(".thumbnail",t).clone().attr("class","pinkynail toggle").prependTo(t);jQuery(".filename.original",t).replaceWith(jQuery(".filename.new",t));jQuery("a.toggle",t).click(function(){jQuery(this).siblings(".slidetoggle").slideToggle(350,function(){var e=jQuery(window).height(),t=jQuery(this).offset().top,n=jQuery(this).height(),r;if(e&&t&&n){r=t+n;r>e&&n+48<e?window.scrollBy(0,r-e+13):r>e&&window.scrollTo(0,t-36)}});jQuery(this).siblings(".toggle").andSelf().toggle();jQuery(this).siblings("a.toggle").focus();return!1});jQuery("a.delete",t).click(function(){jQuery.ajax({url:ajaxurl,type:"post",success:deleteSuccess,error:deleteError,id:e.id,data:{id:this.id.replace(/[^0-9]/g,""),action:"trash-post",_ajax_nonce:this.href.replace(/^.*wpnonce=/,"")}});return!1});jQuery("a.undo",t).click(function(){jQuery.ajax({url:ajaxurl,type:"post",id:e.id,data:{id:this.id.replace(/[^0-9]/g,""),action:"untrash-post",_ajax_nonce:this.href.replace(/^.*wpnonce=/,"")},success:function(t,n){var r=jQuery("#media-item-"+e.id);(type=jQuery("#type-of-"+e.id).val())&&jQuery("#"+type+"-counter").text(jQuery("#"+type+"-counter").text()-0+1);r.hasClass("child-of-"+post_id)&&jQuery("#attachments-count").text(jQuery("#attachments-count").text()-0+1);jQuery(".filename .trashnotice",r).remove();jQuery(".filename .title",r).css("font-weight","normal");jQuery("a.undo",r).addClass("hidden");jQuery("a.describe-toggle-on, .menu_order_input",r).show();r.css({backgroundColor:"#ceb"}).animate({backgroundColor:"#fff"},{queue:!1,duration:500,complete:function(){jQuery(this).css({backgroundColor:""})}}).removeClass("undo")}});return!1});jQuery("#media-item-"+e.id+".startopen").removeClass("startopen").slideToggle(500).siblings(".toggle").toggle()}function itemAjaxError(e,t){var n=jQuery("#media-item-"+e),r=jQuery(".filename",n).text();n.html('<div class="error-div"><a class="dismiss" href="#">'+swfuploadL10n.dismiss+"</a><strong>"+swfuploadL10n.error_uploading.replace("%s",r)+"</strong><br />"+t+"</div>");n.find("a.dismiss").click(function(){jQuery(this).parents(".media-item").slideUp(200,function(){jQuery(this).remove()})})}function deleteSuccess(e,t){if(e=="-1")return itemAjaxError(this.id,"You do not have permission. Has your session expired?");if(e=="0")return itemAjaxError(this.id,"Could not be deleted. Has it been deleted already?");var n=this.id,r=jQuery("#media-item-"+n);(type=jQuery("#type-of-"+n).val())&&jQuery("#"+type+"-counter").text(jQuery("#"+type+"-counter").text()-1);r.hasClass("child-of-"+post_id)&&jQuery("#attachments-count").text(jQuery("#attachments-count").text()-1);if(jQuery("form.type-form #media-items").children().length==1&&jQuery(".hidden","#media-items").length>0){jQuery(".toggle").toggle();jQuery(".slidetoggle").slideUp(200).siblings().removeClass("hidden")}jQuery(".toggle",r).toggle();jQuery(".slidetoggle",r).slideUp(200).siblings().removeClass("hidden");r.css({backgroundColor:"#faa"}).animate({backgroundColor:"#f4f4f4"},{queue:!1,duration:500}).addClass("undo");jQuery(".filename:empty",r).remove();jQuery(".filename .title",r).css("font-weight","bold");jQuery(".filename",r).append('<span class="trashnotice"> '+swfuploadL10n.deleted+" </span>").siblings("a.toggle").hide();jQuery(".filename",r).append(jQuery("a.undo",r).removeClass("hidden"));jQuery(".menu_order_input",r).hide();return}function deleteError(e,t,n){}function updateMediaForm(){var e=jQuery("form.type-form #media-items").children(),t=jQuery("#media-items").children();e.length==1&&jQuery(".slidetoggle",e).slideDown(500).siblings().addClass("hidden").filter(".toggle").toggle();t.not(".media-blank").length>0?jQuery(".savebutton").show():jQuery(".savebutton").hide();t.length>1?jQuery(".insert-gallery").show():jQuery(".insert-gallery").hide()}function uploadSuccess(e,t){if(t.match("media-upload-error")){jQuery("#media-item-"+e.id).html(t);return}prepareMediaItem(e,t);updateMediaForm();jQuery("#media-item-"+e.id).hasClass("child-of-"+post_id)&&jQuery("#attachments-count").text(1*jQuery("#attachments-count").text()+1)}function uploadComplete(e){if(swfu.getStats().files_queued==0){jQuery("#cancel-upload").prop("disabled",!0);jQuery("#insert-gallery").prop("disabled",!1)}}function wpQueueError(e){jQuery("#media-upload-error").show().text(e)}function wpFileError(e,t){var n=jQuery("#media-item-"+e.id),r=jQuery(".filename",n).text();n.html('<div class="error-div"><a class="dismiss" href="#">'+swfuploadL10n.dismiss+"</a><strong>"+swfuploadL10n.error_uploading.replace("%s",r)+"</strong><br />"+t+"</div>");n.find("a.dismiss").click(function(){jQuery(this).parents(".media-item").slideUp(200,function(){jQuery(this).remove()})})}function fileQueueError(e,t,n){if(t==SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED)wpQueueError(swfuploadL10n.queue_limit_exceeded);else if(t==SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT){fileQueued(e);wpFileError(e,swfuploadL10n.file_exceeds_size_limit)}else if(t==SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE){fileQueued(e);wpFileError(e,swfuploadL10n.zero_byte_file)}else if(t==SWFUpload.QUEUE_ERROR.INVALID_FILETYPE){fileQueued(e);wpFileError(e,swfuploadL10n.invalid_filetype)}else wpQueueError(swfuploadL10n.default_error)}function fileDialogComplete(e){try{e>0&&this.startUpload()}catch(t){this.debug(t)}}function switchUploader(e){var t=document.getElementById(swfu.customSettings.swfupload_element_id),n=document.getElementById(swfu.customSettings.degraded_element_id);if(e){t.style.display="block";n.style.display="none"}else{t.style.display="none";n.style.display="block"}}function swfuploadPreLoad(){uploaderMode?switchUploader(0):switchUploader(1)}function swfuploadLoadFailed(){switchUploader(0);jQuery(".upload-html-bypass").hide()}function uploadError(e,t,n){switch(t){case SWFUpload.UPLOAD_ERROR.MISSING_UPLOAD_URL:wpFileError(e,swfuploadL10n.missing_upload_url);break;case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:wpFileError(e,swfuploadL10n.upload_limit_exceeded);break;case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:wpQueueError(swfuploadL10n.http_error);break;case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:wpQueueError(swfuploadL10n.upload_failed);break;case SWFUpload.UPLOAD_ERROR.IO_ERROR:wpQueueError(swfuploadL10n.io_error);break;case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:wpQueueError(swfuploadL10n.security_error);break;case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:jQuery("#media-item-"+e.id).remove();break;default:wpFileError(e,swfuploadL10n.default_error)}}function cancelUpload(){swfu.cancelQueue()}var topWin=window.dialogArguments||opener||parent||top;jQuery(document).ready(function(e){e('input[type="radio"]',"#media-items").live("click",function(){var t=e(this).closest("tr");e(t).hasClass("align")?setUserSetting("align",e(this).val()):e(t).hasClass("image-size")&&setUserSetting("imgsize",e(this).val())});e("button.button","#media-items").live("click",function(){var t=this.className||"";t=t.match(/url([^ '"]+)/);if(t&&t[1]){setUserSetting("urlbutton",t[1]);e(this).siblings(".urlfield").val(e(this).attr("title"))}})});