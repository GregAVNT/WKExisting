/*
	Cookie Plug-in
	
	This plug in automatically gets all the cookies for this site and adds them to the post_params.
	Cookies are loaded only on initialization.  The refreshCookies function can be called to update the post_params.
	The cookies will override any other post params with the same name.
*/var SWFUpload;if(typeof SWFUpload=="function"){SWFUpload.prototype.initSettings=function(e){return function(){typeof e=="function"&&e.call(this);this.refreshCookies(!1)}}(SWFUpload.prototype.initSettings);SWFUpload.prototype.refreshCookies=function(e){e===undefined&&(e=!0);e=!!e;var t=this.settings.post_params,n,r=document.cookie.split(";"),i=r.length,s,o,u,a;for(n=0;n<i;n++){s=r[n];while(s.charAt(0)===" ")s=s.substring(1,s.length);o=s.indexOf("=");if(o>0){u=s.substring(0,o);a=s.substring(o+1);t[u]=a}}e&&this.setPostParams(t)}};