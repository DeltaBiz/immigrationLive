// JavaScript Document



function getVideoPlayer( src, w, h, videoPath, skinBackgroundColor, autoPlay, previewPath, pausePath )

{

	var rel = src;

	

	if ( rel.lastIndexOf("/") >= 0 )

		rel = rel.substr(0, rel.lastIndexOf("/") + 1);

	else

		rel = "./";

		

	if ( autoPlay == false )

		autoPlay = "no";

	else

		autoPlay = "yes";

		

	if ( previewPath === undefined )

		previewPath = "";

		

	if ( pausePath === undefined )

		pausePath = "";



	var skinSrc = "SkinDeltaOverSeek.swf";

	

	var FlashVars = "w=" + w + "&h=" + h + "&skinSrc=" + skinSrc + "&skinBackgroundColor=" + skinBackgroundColor + "&videoPath=" + videoPath + "&previewPath=" + previewPath + "&pausePath=" + pausePath + "&rel=" + rel + "&autoplay=" + autoPlay;



	return AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0','wmode','transparent','width',w,'height',h,'src',src,'quality','high','allowFullScreen','true','allowScriptAccess','sameDomain','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie',src.substr(0, src.lastIndexOf("." ) ),'FlashVars',FlashVars);

}



function insertVideoPlayer( src, w, h, videoPath, skinBackgroundColor, autoPlay, previewPath, pausePath )

{
	
	document.write(getVideoPlayer( src, w, h, videoPath, skinBackgroundColor, autoPlay, previewPath, pausePath ));

}

function switchVideo(divID,src) {
	
	$(''+divID+'').innerHTML = getVideoPlayer( "../videoPlayer/videoPlayer.swf", 400, 300, src, "000000", true, "../images/playVideo.png", "../images/pauseVideo.png" );
}