<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>

               <br><br>

               <div>
                  <form action="{{url('search_product')}}" method="GET">

                     @csrf

                     <input type="text" name="search" placeholder="Search Product" style="padding-left: 20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px; width: 500px; margin-bottom: 20px;">
                     <input type="submit" class="btn btn-primary" value="Search">
                  </form>
               </div>
               @include('sweetalert::alert')
            </div>

            @if(Session::has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              {{Session()->get('message')}}
            </div>
            @endif
            
            <div class="row">


               @foreach($product as $products)

               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_details',$products->id)}}" class="option1">
                           Product Details
                           </a>
                           
                           <form action="{{url('add_cart',$products->id)}}" method="Post">
                              @csrf
                              
                              <div class="row">
                                 <div class="col-md-4">
                                 <input type="number" name="quantity" value="1" min="1" max="{{$products->quantity}}" style="width:100px;">

                                 </div>
                                 
                                 <div class="col-md-4">
                                    <input type="submit" value="Add to Cart" class="btn btn-primary">
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="product/{{$products->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$products->title}}
                        </h5>
                        
                        @if($products->discount_price!=null)
                        <h6 style="color: green;">
                           Discount Price:
                           <br>
                           ${{$products->discount_price}}
                        </h6>
                        <h6 style="text-decoration: line-through; color:grey;">
                           Price:
                           <br>
                           ${{$products->price}}
                        </h6>
                        @else
                        <h6 style="color:green;">
                           Price:
                           <br>
                           ${{$products->price}}
                        </h6>
                        
                        @endif

                     </div>
                  </div>
               </div>
               
               @endforeach

               <span style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">

               {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
               </span>
         </div>
      </section>