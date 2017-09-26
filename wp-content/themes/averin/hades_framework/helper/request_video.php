<?php


$trick_src = explode("{titan}",$_GET["src"]);


$video_code = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<data>
	<settings>
		<cWidth>$trick_src[2]</cWidth><!-- Native size : 300 -->
		<cHeight>$trick_src[1]</cHeight><!-- Native size : 250 -->
		<hHeight tweenType = "easeoutquad" tweenTime = "0.3">26</hHeight><!-- Default: 26 -->
		<controllerH tweenType = "easeoutquad" tweenTime = "0.3">26</controllerH><!-- Default: 26 -->
		<playPause hitAreaW = "18" hitAreaH = "26" top = "0" left = "5"></playPause>
		<progressBar top = "7" left = "5" hitAreaH = "12" partTimeAlpha = "0.5"totalTimeAlpha = "0.3" partTop = "0" partLeft = "2" totalTop = "0" totalLeft = "1" sepTop = "1" sepLeft = "0" timeTop = "1" timeLeft = "7" initChars = "00:00">
		</progressBar>
		<volume mouseWheelStep = "0.05" bgHeight = "26" iconHitAreaW = "11" iconHitAreaH = "26" volBarHitAreaW = "51" volBarHitAreaH = "10" 			volBarW = "51" iconTop = "0" iconLeft = "1" volBarTop = "8" volBarLeft = "5" top = "0" right = "4" left = "10" >0.75</volume>
		
		<fullScreen hideMenuDelay = "2000" hitAreaW = "20" hitAreaH = "26" top = "0" left = "5"></fullScreen>
		<toolTip bgH = "19" lblAlpha = "0.3" trackAlpha = "0.5" top = "1" left = "0" txtTop = "4" txtLeft = "5">PLAY: </toolTip>
		<thumbnail autoClose = "false" bgH = "90" thumbW = "76" thumbH = "76" top = "5" left = "5" edgeTolerance = "81"></thumbnail>
		<playBtn width = "72" height = "72" signW = "28" signH = "36" nAlpha = "0.6" oAlpha = "0.8" signNalpha = "0.8" signOalpha = "0.8"></playBtn>
		<title lblAlpha = "0.3" titleAlpha = "0.5" titleLeft = "0" titleTop = "8" lblLeft = "8" lblTop = "8">NOW PLAYING: </title>
		<playlist usePlaylist = "false" nAlpha = "0.3" oAlpha = "0.5" txtTop = "8" txtLeft = "10" top = "0" left = "0" signTop = "11" signLeft = "3" hitAreaH = "26">PLAYLIST</playlist>
		<playlistClosed>CLOSE PLAYLIST</playlistClosed>
		
		<videoPlay autoPlay = "false" autoLoad = "true" goNext = "true" repeat = "true" shuffle = "false" autoHide = "true" videoBgColor = "0x000000" videoBgAlpha = "0.8"></videoPlay>

	</settings>
	
	<content>
		<youTube imDisabled = "true" name = "YOUTUBE" loaderColor = "0xffffff">
		</youTube>
		<localVideo imDisabled = "false" name = "LOCAL VIDEO" loaderColor = "0xffffff">
			<settings>
				<bufferTime>1</bufferTime><!-- value in seconds -->
				<smoothing>true</smoothing>
				<vidNotFound top = "0" left = "0" textLeft = "5" textTop = "5" txtAlpha = "0.5"><![CDATA[<p>The requested video has been removed</p>]]></vidNotFound>
				<errorExecDelay>2000</errorExecDelay>
			</settings>
			<videos>
				<video startWithMe = "true">
					<title>$trick_src[3]</title>
					<vidURL fit = "fitToSizeForced">$trick_src[0]</vidURL>
				
				</video>
			</videos>
		</localVideo>
	</content>
</data>
EOT;

echo $video_code;
?>
