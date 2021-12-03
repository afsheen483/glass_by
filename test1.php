<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Video Camera </title>
    <!--<link rel="stylesheet" href="./js/main.css" />-->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="./js/twilio-video.min.js"></script>



  </head>
  <body>

<div class="container" id="container">
<div class="row">
<div class="col-md-12">
  <img src="./js/camera-overlay.png" style="display: block;position: fixed;margin-left: inherit;margin-right: auto;border: 1px solid rgba(255, 255, 255, 0.7);font-size: 14px;color: rgba(255, 255, 255, 1.0);cursor: pointer;z-index: 1">

  <div  id="video-div">
       

  </div>
  
  <canvas id="canvas"></canvas>
</div>
</div>
    

   
  
   

<script>
const container = document.getElementById("video-div");
var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
video = "";
function step() {
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height)
    requestAnimationFrame(step)
}
  
  
 
async function startVideo() {
  const track = await Twilio.Video.createLocalVideoTrack();
  container.append(track.attach());
  video = document.getElementsByTagName("video")[0];
  
  requestAnimationFrame(step);
}

document.addEventListener("DOMContentLoaded", function(event) { 
    startVideo();
});

</script>

  </body>
</html>
