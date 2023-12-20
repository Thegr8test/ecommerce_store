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
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
      
                <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width:50%; padding:30px">
                  
                    <div class="img-box" style="padding-bottom: 20px;">
                     
                    <img src="/product/{{$product->image}}" alt="">
                     
                     <div class="detail-box">
                        <h5 style="padding-top: 20px;">
                           {{$product->title}}
                        </h5>
                        
                        @if($product->discount_price!=null)
                        <h6 style="color: green;">
                           Discount Price:
                           <br>
                           ${{$product->discount_price}}
                        </h6>
                        <h6 style="text-decoration: line-through; color:grey;">
                           Price:
                           <br>
                           ${{$product->price}}
                        </h6>
                        @else
                        <h6 style="color:green;">
                           Price:
                           <br>
                           ${{$product->price}}
                        </h6>
                        
                        @endif

                        <h6>Product Category: {{$product->category}}</h6>
                        <h6>Product Description: {{$product->description}}</h6>
                        <h6>Product Quantity: {{$product->quantity}}</h6>

                            
                           <form action="{{url('add_cart',$product->id)}}" method="Post">
                              @csrf
                              
                              <div class="row">
                                 <div class="col-md-4">
                                 <input type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}" style="width:100px;">

                                 </div>
                                 
                                 <div class="col-md-4">
                                    <input type="submit" value="Add to Cart" class="btn btn-primary">
                                 </div>
                              </div>
                           </form>
                        <a href="{{url('/')}}" class="btn btn-success">View More</a>
                     </div>
                  </div>
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