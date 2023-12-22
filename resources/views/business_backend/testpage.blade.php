<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="AboveMarts Test Page">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>VTUBIZ | Giveaway Test Portal</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="{{asset('testassets/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('testassets/plugins/jquery-steps/jquery.steps.css')}}">

<!-- Custom Css -->
<link rel="stylesheet" href="{{asset('testassets/css/style.min.css')}}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Grandstander:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">

<style>
   

    body {
        margin: 0;
        font-family: 'Montserrat', sans-serif;
        background:#191970;
        background-image: radial-gradient(circle, #ffffff, #aaaaaa);
    }

    canvas {
        position: fixed;
        top: 0;
        bottom: 0;
        z-index: 1;
    }

    h1 {
        font-size: 30px;
        text-align: center;
        width: 60%;
        margin: 0 auto;
        color:#fff;
        padding-top: 10%;
        font-family: 'Grandstander', cursive;
    }
    h4 {
        color:#fff;
        font-family: 'Grandstander', cursive;
        font-size:20px;
    }

    h2 {
        font-size: 20px;
        text-align: center;
        width: 60%;
        margin: 0 auto;
        padding-top: 10%;
        color: #ebab21;
        font-family: 'Grandstander', cursive;
    }
    td {
        font-size: 15px !important;

    }


    p {
        font-size: 20px;
        text-align: center;
        /* width: 50%; */
        margin: 1em auto 0;
        color: #1cbfd0;
        font-family: 'Grandstander', cursive;
    }


    .collection {
        position: fixed;
        z-index: 1000;
        width: auto;
        bottom: 0;
        right: 0;
        margin: 15px;
        padding: 0;
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
    }

    .collection a {
        display: inline-block;
        background: #fff;
        opacity: 0.4;
        transition: opacity 0.7s;
        margin-left: 5px;
        padding: 5px;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: bold;
        color: #000;
    }
 

    .collection a:hover {
        opacity: 1;
    }

    .splash-container {
        display: inline-block;
        position: relative;
    }

    .splash-container::before {
        content: 'CTtaste';
        display: block;
        background: linear-gradient(135deg, #ff6600, #ffcc00);
        color: white;
        padding: 5px 10px;
        border-radius: 10px;
        font-weight: bold;
        position: absolute;
        top: -10px;
        left: -10px;
        z-index: -1;
    }
 

    .confetti-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        /* Prevent interaction with confetti */
        z-index: 9999;
        /* Place confetti above everything */

    }

    .confetti {
        width: 10px;
        height: 10px;
        position: absolute;
        background: #98FB98;
        animation: confetti-fall 3s ease-out infinite;
    }

    @keyframes confetti-fall {
        0% {
            transform: translateY(0);
            opacity: 1;
        }

        35% {

            background: red;
            opacity: 0.7;
        }

        70% {

            background: #ebab21;
            opacity: 0.35;
        }

        100% {
            transform: translateY(100vh);
            opacity: 0;
        }
    }
</style>
</head>

<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="{{ asset('assets/img/logo/vtulogo.png') }}" width="48" height="48" alt="VTUBIZ"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>




<!-- Right Sidebar -->


<section class="content" style='margin:20px !important;background:#191970'>
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <h1>{{ $giveaway->name }}</h1>
                    <h4>You have been giving some questions by <span style='color:red'>{{ $giveaway->user->name }}</span>, answer the questions correctly to claim the giveaway.</h4>
                  
                </div>
                <div class="col-lg-12 col-md-6 col-sm-12">                
                    <button><div id='countdown'></div></button>                                
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Basic Example | Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2 class='text-white'>Duration: {{$time}} Minutes</h2>
                            <input type='hidden' value='{{$time}}' id='time'>
                          
                        </div>
                        <div class="body" style='background:black;color:#fff'>
                            <div id="wizard_horizontal" >
                                @foreach($giveawayQuestions as $key => $question)
                                <h2>Question {{++$key}}</h2>
                                <section>
                                    <p>{{$question->question}}</p>
                                    <input id='userId' type='hidden' value='{{$participant->id}}'>
                                    
                                    <input id='testId' type='hidden' value='{{$giveaway->id}}'>
                                    <input id='questionId' type='hidden' data-id="{{$question->id}}">
                                    <ol>
                                        @foreach($question->answers as $answer)



                                        
                                            <li><label>
                                        <input id='answerId' type='radio'  class='testoption' data-id="{{$answer->id}}" name='answer'> {{$answer->answer}}
                                            </label> </li>
                                        @endforeach
                                    <ol>

                                </section>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Jquery Core Js --> 
<script src="{{asset('testassets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('testassets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->

<script src="{{asset('testassets/plugins/jquery-validation/jquery.validate.js')}}"></script> <!-- Jquery Validation Plugin Css -->
<script src="{{asset('testassets/plugins/jquery-steps/jquery.steps2.js')}}"></script> <!-- JQuery Steps Plugin Js -->

<script src="{{asset('testassets/bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js -->
<script src="{{asset('testassets/js/pages/forms/form-wizard.js')}}"></script>
<script src="{{asset('testassets/jquerycountdown/cdn/jquery.min.js')}}"></script>
<script src="{{asset('testassets/jquerycountdown/dist/jquery.countdown360.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready( function() {
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $timeInseconds = $("#time").val() * 60;
//    alert( $timeInseconds)

    var countdown = $("#countdown").countdown360({
    radius      : 35.5,
    seconds     :  $timeInseconds,
    
    strokeWidth: undefined,
   
    fontColor:"#477050",
    fontFamily:"sans-serif",
    label: ["second","seconds"],
    fontSize: undefined,
    fontColor   : '#FFFFFF',
    autostart   : false,
    onComplete  : function () {  
        swal('info','Test Successfully Completed','info')
        window.location.href = `https://vtubiz.com/viewresult/${$("#userId").val()}/${$("#testId").val()}`;

    }
});
countdown.start();
$(".testoption").click(function() {

    var answerId = $(this).data('id')
    var questionId = $("#questionId").data('id')
    var testId = $("#testId").val()
    var userId = $("#userId").val()
   

                // var id = $("#profileId").val();

                fd = new FormData();

                // fd.append('id', id);
                fd.append('questionId', $("#questionId").val());
                fd.append('testId', $("#testId").val());
                fd.append('answerId', answerId);
                fd.append('userId', userId);
               

                console.log(fd, 'this is the fd');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('submittest') }}",
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        // console.log(data)
                        // window.location.reload();
                    },
                    error: function(data) {
                        console.log(data);
                        
                    }
                });
            
   
})
})
</script>

<script>
       
    $(document).ready(function() {
      

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      // Function to create confetti elements
function createConfetti() {
const confettiContainer = document.createElement('div');
confettiContainer.classList.add('confetti-container');
document.body.appendChild(confettiContainer);

for (let i = 0; i < 50; i++) {
const confetti = document.createElement('div');
confetti.classList.add('confetti');
confetti.style.left = Math.random() * 100 + 'vw';
confetti.style.animationDuration = Math.random() * 2 + 1 + 's';
confettiContainer.appendChild(confetti);
}

// Optionally return the container element if you need to manipulate it later
return confettiContainer;
}

// Function to remove confetti elements
function removeConfetti(confettiContainer) {
if (confettiContainer) {
confettiContainer.remove();
}
}

const confettiContainer = createConfetti();


      })
</script>
</body>
</html>