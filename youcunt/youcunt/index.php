<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
	
  </head>
  <body>
  <div id="cuntvideo_container" hidden=true;>
	<video id="cuntvideo" width="1024" height="720" controls controlsList="nodownload">
		<source id="videovideo" src="Youareacunt.mp4" type="video/mp4">
	</video>
	</div>
  <div class="clouds" id="clouds" hidden>	
</div>
  
	 
	<div id="content">
	
		<div id="startbutton" onclick="start_up()">START</div>
	</div>

<script>
		
		function playmyaudio()
		{
			var audio = document.getElementById("myaudio").play();
		}
		function sleep(ms) 
		{
			return new Promise(resolve => setTimeout(resolve, ms));
		}
		
		async function start_up()
		{
			var displayedwords = ["Hey", "You", "are", "a", "cunt"];
			var contentdisplay = document.getElementById("content");
			var msg = new SpeechSynthesisUtterance();
				msg.rate = 0.8;
				msg.text = "Hey you are a cunt";
				window.speechSynthesis.speak(msg);
				await new Promise(r => setTimeout(r, 500));
			for(var i = 0; i < displayedwords.length; i++)
			{
				contentdisplay.innerHTML = displayedwords[i];
				await new Promise(r => setTimeout(r, 200));
			}
			var cloudcontainer = document.getElementById("clouds");
			var myvideo = document.getElementById("cuntvideo_container");
			var videovideo = document.getElementById("cuntvideo");
			cloudcontainer.hidden = false;
			myvideo.hidden = false;
			videovideo.play();
			start_again();
		}
		
		async function start_again()
		{
			
			await new Promise(r => setTimeout(r, 144000));
			var cloudcontainer = document.getElementById("clouds");
			var myvideo = document.getElementById("cuntvideo_container");
			cloudcontainer.innerHTML = '';
			cloudcontainer.hidden = true;
			myvideo.hidden = true;
			var contentdisplay = document.getElementById("content");
			contentdisplay.innerHTML = '<div id="startbutton" onclick="start_up()">START</div>';
			cuntbackground();
			
		}
		
		
		function randomIntFromInterval(min, max) 
		{ // min and max included 
			return Math.floor(Math.random() * (max - min + 1) + min)
		}
		async function cuntbackground()
		{
			var count = 0;
			var cloudcontainer = document.getElementById("clouds");
			
			while(count < 800)
			{
				var randpos = randomIntFromInterval(10, 4000);
				var randspeed = randomIntFromInterval(1, 20);
				var randsize = randomIntFromInterval(1, 5);
				var perspective = randomIntFromInterval(1, 50);
				var elem = document.createElement('div');
				var offset = randsize*3.5;
				elem.style.cssText = 'color: #770d8c; border-radius: 10px; padding: 5px; text-shadow: '+offset+'px '+offset/0.5+'px 7.5px black; perspective:'+perspective+'em; font-family: calibri; position: absolute;left: ' + randpos +'px;height: -150px;animation: move '+randspeed+'s linear 0s infinite; width: auto; font-size:' + randsize +'em;';
				elem.innerHTML = "You are a cunt";
				//document.body.appendChild(elem);
				cloudcontainer.appendChild(elem);
				await new Promise(r => setTimeout(r, 150));
				console.log("Created!");
				count++;
			}
		}
		cuntbackground();
	</script>
 </body>
</html>