<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
   </head>
   <body>

      @include('sweetalert::alert')

      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.product')
      <!-- end product section -->

      <!-- comment and replay system -->

      <div style="text-align: center; padding-bottom: 30px; padding-left: 30px; padding-right: 30px;">
         <h1 style="text-align: center; font-size: 30px; padding-top: 20px; padding-bottom: 20px; height: 150px; width:600px;">Comment and Replay System</h1>
         
         <form action="{{url('add_comment')}}" method="post">

            @csrf

            <textarea placeholder="comment here" style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px; width: 100%; margin-bottom: 20px;" name="comment"></textarea>

            <br>
            <input type="submit" class="btn btn-primary" value="Comment">

         </form>

         <div style="text-align: center; padding-bottom: 30px; padding-left: 10px;">
            <h1 style="text-align: center; font-size: 30px; padding-top: 20px; padding-bottom: 20px; height: 150px; width:600px; text-align: left; padding-left: 20px;">All Comments</h1>


            @foreach($comment as $comment)
            <div style="text-align: left; padding-left: 20px;">
               <b>{{$comment->name}}</b>
               <p>{{$comment->comment}}</p>

               <a style="color: blue;" href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}">Replay</a>

               @foreach($reply as $rep)

               @if($rep->comment_id==$comment->id)
               <div style="padding-left: 3%; padding-bottom: 10px; padding-bottom: 10px;">

                  <b>{{$rep->name}}</b>
                  <p>{{$rep->reply}}</p>
                  <a href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}">Replay</a>

               </div>
               @endif

               @endforeach
            </div>
            @endforeach
            
         </div>

         <div style="text-align: left; padding-left: 30px; padding-right: 30px; display: none;" class="replyDiv">
         
         <form action="{{url('add_reply')}}" method="post">
            @csrf

         <input type="hidden" name="commentId" id="commentId" >
         <textarea placeholder="replay here" style="height: 100px; width: 500px;" name="reply"></textarea>
         <br>

         <button type="submit" class="btn btn-primary">Replay</button>
         <a href="javascript::void(0);" class="btn btn-danger" onClick="reply_close(this)">Cancel</a>
      
         </form>

      
      </div>
      </div>
      


      <!-- end comment and replay system -->

      <!-- subscribe section -->
      @include('home.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
      @include('home.client')
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>


      <script type="text/javascript">
         function reply(caller)
         {
            
            document.getElementById('commentId').value=$(caller).attr('data-Commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
         }
         function reply_close(caller)
         {
            $('.replyDiv').hide();
         }
      </script>

      <script>
         document.addEventListener("DOMContentLoaded", function(event) { 
               var scrollpos = localStorage.getItem('scrollpos');
               if (scrollpos) window.scrollTo(0, scrollpos);
         });

         window.onbeforeunload = function(e) {
               localStorage.setItem('scrollpos', window.scrollY);
         };
      </script>

      <!-- jQuery -->
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
        <!-- Popper.js -->
        <script src="{{asset('home/js/popper.min.js')}}"></script>
        <!-- Bootstrap.js -->
        <script src="{{asset('home/js/bootstrap.js')}}"></script>
        <!-- Custom.js -->
        <script src="{{asset('home/js/custom.js')}}"></script>
   </body>
</html>