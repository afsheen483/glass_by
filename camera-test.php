<div class="camera">
             <style>
                 video {
      -webkit-transform: scaleX(-1);
      transform: scaleX(-1);
    }
             </style>
                <video id="video" style="max-width: 400px;width:100%;
    height: 300px;">Video stream not available.</video>
            </div>
          
            <!--<div><button id="startbutton" type="button" onclick="takepicture_timer()">Take photo</button></div>-->
            <canvas id="canvas"></canvas>
            <div class="output" style="display:none; width:100%;">
                <img id="photo" alt="The screen capture will appear in this box.">
            </div>
        
        </div>
        
        
<script>

function clearphoto() {
            var context = canvas.getContext('2d');
            context.fillStyle = "#AAA";
            context.fillRect(0, 0, canvas.width, canvas.height);

            var data = canvas.toDataURL('image/png');
            photo.setAttribute('src', data);
        }
        
    function startup() {
            video = document.getElementById('video');
            canvas = document.getElementById('canvas');
            photo = document.getElementById('photo');
            startbutton = document.getElementById('startbutton');

            navigator.mediaDevices.getUserMedia({
                    video: true,
                    audio: false
                })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function(err) {
                    console.log("An error occurred: " + err);
                });

            video.addEventListener('canplay', function(ev) {
                if (!streaming) {
                    height = video.videoHeight / (video.videoWidth / width);

                    if (isNaN(height)) {
                        height = width / (4 / 3);
                    }

                    video.setAttribute('width', width);
                    video.setAttribute('height', height);
                    canvas.setAttribute('width', width);
                    canvas.setAttribute('height', height);
                    streaming = true;
                }
            }, false);

            startbutton.addEventListener('click', function(ev) {
                // takepicture_timer();
                ev.preventDefault();
            }, false);

            clearphoto();
        }
        
        startup();
</script>