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

      <style type="text/css">
          .center {
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: auto;
            width: 60%;
            padding: 30px;
            text-align: center;
          }
          table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
          }
          .th_deg{
            background-color: lightcoral;
            color: white;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
          }





      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
        <div class="center">
            @if(session('msg'))
            <div class="alert alert-success">
                {{session('msg')}}
            </div>
            @endif

            <table>

                <tr>

                    <th class="th_deg">product title</th>
                    <th class="th_deg">quantity</th>
                    <th class="th_deg">price</th>
                    <th class="th_deg">payment status</th>
                    <th class="th_deg">delivery status</th>
                    <th class="th_deg">image</th>
                    <th class="th_deg">action</th>
                    <th class="th_deg">Order Details</th>

                
                </tr>

                @foreach($order as $order)
                <tr>

                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td><img width="150px" height="200px" src="product/{{$order->image}}"></td>
                    <td>
                        @if($order->delivery_status=='pending')
                        <a onclick="return confirm('Are you sure you want to cancel this order ?')" class="btn btn-outline-danger" href="{{url('cancel_order',$order->id)}}">Cancel Order</a>
                        @else
                        <p style="color: green; font-weight: bold">Thankyou !</p>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-outline-info" href="{{url('print_pdf',$order->id)}}">Print Details</a>
                </tr>
                @endforeach

            </table>


        </div>
      </div>
        
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
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