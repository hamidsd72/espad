<!DOCTYPE html>
<html dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="{{url('source/asset/assets/website/css/call.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @livewireStyles
</head>
<body>
<header>
  <img src="{{$user1 && $user1->photo?url($user1->photo->path):url('file_call/img/user_call.png')}}"
       alt="{{$call->unique_code}}">
  <span>{{$user1 ? $user1->first_name.' '.$user1->last_name:'بدون نام'}}</span>
</header>

@livewire('repling',['unique_code'=>$unique_code])

<footer>
  <div class="container">
    <div class="row">
      <div class="col-4 text-center">
        <a href="javascript:void(0)" id="btn_muted_microphone" onclick="muted_mic(false)">
          <i class="fas fa-microphone mic-svg"></i>
          {{--          <i class="fas fa-microphone-slash mic-svg"></i>--}}
        </a>
      </div>
      <div class="col-4 text-center">
        <a href="{{route('user.call.end',$call->unique_code)}}" class="end_call">
          <i class="fa-solid fa-phone"></i>
        </a>
      </div>
      <div class="col-4 text-center">
        <a href="javascript:void(0)" id="btn_muted_speaker" onclick="muted_speaker(true)">
          {{--          <i class="fa-solid fa-volume-xmark"></i>--}}
          <i class="fa-solid fa-volume-high  vol-svg"></i>
        </a>
      </div>
    </div>
  </div>
</footer>

<div>
  <video id="localVideo" autoplay="true" muted="muted"></video>
  <video id="remoteVideo" autoplay="true" style="display:none"></video>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script type="text/javascript">

    var answer = 0;
    var pc=null
    var localStream=null;
    var ws=null;
    var stream_play=null;


    // Not necessary with websockets, but here I need it to distinguish calls
    var unique = Math.floor(100000 + Math.random() * 900000);
    var unique_url = {{$unique_code}};

    var localVideo = document.getElementById('localVideo');
    var remoteVideo = document.getElementById('remoteVideo');
    var configuration  = {
        'iceServers': [
            { 'urls': 'stun:stun.stunprotocol.org:3478' },
            { 'urls': 'stun:stun.l.google.com:19302' },
            //{'urls': 'stun:stun1.l.google.com:19302' },
            //{'urls': 'stun:stun2.l.google.com:19302' }
        ]
    };

    // Start
    navigator.mediaDevices.getUserMedia({
        audio: true, // audio is off here, enable this line to get audio too
        // video: true
    }).then(function (stream) {
        localVideo.srcObject = stream;
        localStream = stream;
        try {
            ws = new EventSource('https://adibhost.ir/file_call/serverGet.php?unique='+unique+'&unique_url='+unique_url);
        } catch(e) {
            console.error("Could not create eventSource ",e);
        }

        // Websocket-hack: EventSource does not have a 'send()'
        // so I use an ajax-xmlHttpRequest for posting data.
        // Now the eventsource-functions are equal to websocket.
        ws.send = function send(message) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState!=4) {
                    return;
                }
                if (this.status != 200) {
                    console.log("Error sending to server with message: " +message);
                }
            };
            xhttp.open('POST', 'https://adibhost.ir/file_call/serverPost.php?unique='+unique+'&unique_url='+unique_url, true);
            xhttp.setRequestHeader("Content-Type","Application/X-Www-Form-Urlencoded");
            xhttp.send(message);
        }

        // Websocket-hack: onmessage is extended for receiving
        // multiple events at once for speed, because the polling
        // frequency of EventSource is low.
        ws.onmessage = function(e) {
            if (e.data.includes("_MULTIPLEVENTS_")) {
                multiple = e.data.split("_MULTIPLEVENTS_");
                for (x=0; x<multiple.length; x++) {
                    onsinglemessage(multiple[x]);
                }
            } else {
                onsinglemessage(e.data);
            }
        }

        // Go show myself
        localVideo.addEventListener('loadedmetadata',
            function () {
                publish('client-call', null)
            }
        );
    }).catch(function (e) {
        console.log("Problem while getting audio/video stuff ",e);
    });


    function onsinglemessage(data) {
        var package = JSON.parse(data);
        var data = package.data;
        console.log("received single message: " + package.event);
        switch (package.event) {
            case 'client-call':
                icecandidate(localStream);
                pc.createOffer({
                    offerToReceiveAudio: 1,
                    offerToReceiveVideo: 1
                }).then(function (desc) {
                    pc.setLocalDescription(desc).then(
                        function () {
                            publish('client-offer', pc.localDescription);
                        }
                    ).catch(function (e) {
                        console.log("Problem with publishing client offer"+e);
                    });
                }).catch(function (e) {
                    console.log("Problem while doing client-call: "+e);
                });
                break;
            case 'client-answer':
                if (pc==null) {
                    console.error('Before processing the client-answer, I need a client-offer');
                    break;
                }
                pc.setRemoteDescription(new RTCSessionDescription(data),function(){},
                    function(e) { console.log("Problem while doing client-answer: ",e);
                    });
                break;
            case 'client-offer':
                icecandidate(localStream);
                pc.setRemoteDescription(new RTCSessionDescription(data), function(){
                    if (!answer) {
                        pc.createAnswer(function (desc) {
                                pc.setLocalDescription(desc, function () {
                                    publish('client-answer', pc.localDescription);
                                }, function(e){
                                    console.log("Problem getting client answer: ",e);
                                });
                            }
                            ,function(e){
                                console.log("Problem while doing client-offer: ",e);
                            });
                        answer = 1;
                    }
                }, function(e){
                    console.log("Problem while doing client-offer2: ",e);
                });
                break;
            case 'client-candidate':
                if (pc==null) {
                    console.error('Before processing the client-answer, I need a client-offer');
                    break;
                }
                pc.addIceCandidate(new RTCIceCandidate(data), function(){},
                    function(e) { console.log("Problem adding ice candidate: "+e);});
                break;
        }
    };

    function icecandidate(localStream) {
        pc = new RTCPeerConnection(configuration);
        pc.onicecandidate = function (event) {
            if (event.candidate) {
                publish('client-candidate', event.candidate);
            }
        };
        try {
            pc.addStream(localStream);
        }catch(e){
            var tracks = localStream.getTracks();
            for(var i=0;i<tracks.length;i++){
                pc.addTrack(tracks[i], localStream);
            }
        }
        pc.ontrack = function (e) {
            document.getElementById('remoteVideo').style.display="block";
            document.getElementById('localVideo').style.display="block";
            remoteVideo.srcObject = e.streams[0];
        };
    }

    function publish(event, data) {
        console.log("sending ws.send: " + event);
        ws.send(JSON.stringify({
            event:event,
            data:data
        }));
    }
    function muted_speaker(a)
    {
        var spic_muted = document.getElementById("remoteVideo");
        spic_muted.muted = a;
        if(a===true)
        {
            document.getElementById('btn_muted_speaker').setAttribute('onclick','muted_speaker(false)')
            $('.vol-svg').addClass('fa-volume-xmark')
            $('.vol-svg').removeClass('fa-volume-high')
            // document.getElementById('btn_muted_speaker').innerText='روشن کردن بلندگو'
        }
        else
        {
            document.getElementById('btn_muted_speaker').setAttribute('onclick','muted_speaker(true)')
            $('.vol-svg').removeClass('fa-volume-xmark')
            $('.vol-svg').addClass('fa-volume-high')
            // document.getElementById('btn_muted_speaker').innerText='خاموش کردن بلندگو'
        }
    }
    function muted_mic(a)
    {
        localStream.getAudioTracks()[0].enabled=a;
        if(a==true)
        {
            document.getElementById('btn_muted_microphone').setAttribute('onclick','muted_mic(false)')
            $('.mic-svg').removeClass('fa-microphone-slash')
            $('.mic-svg').addClass('fa-microphone')
            // document.getElementById('btn_muted_microphone').innerText='خاموش کردن میکروفون'
        }
        else
        {
            document.getElementById('btn_muted_microphone').setAttribute('onclick','muted_mic(true)')
            $('.mic-svg').addClass('fa-microphone-slash')
            $('.mic-svg').removeClass('fa-microphone')
            // document.getElementById('btn_muted_microphone').innerText='روشن کردن میکروفون'
        }
    }
    function muted_video(a)
    {
        localStream.getVideoTracks()[0].enabled=a;
        if(a==true)
        {
            document.getElementById('btn_muted_video').setAttribute('onclick','muted_video(false)')
            document.getElementById('btn_muted_video').innerText='خاموش کردن دوربین'
        }
        else
        {
            document.getElementById('btn_muted_video').setAttribute('onclick','muted_video(true)')
            document.getElementById('btn_muted_video').innerText='روشن کردن دوربین'
        }
    }


</script>
@yield('js')

@livewireScripts

</body>
</html>