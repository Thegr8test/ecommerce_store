<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">

        .div_center{
            text-align: center;
            padding-top: 40px;
        }
        .font_size{
            font-size: 40px;
            padding: 40px;
        }
        .text_color{
            color: black;

        }  
        label{
            display: inline-block;
            width: 200px;
        }
        .div_design{
            padding-bottom: 15px;
        }

    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
    
    <div class="main-panel">
        <div class="content-wrapper">

            @if(Session::has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
              {{Session()->get('message')}}
            </div>
            @endif
            
            <div class="div_center">
                <h1 class="font_size">Edit Product</h1>

                <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="div_design">

                <label>Product Title</Title></label>
                <input class="text_color"type="text" name="title" placeholder="Write a title" required="" value="{{$product->title}}">
                </div>
                <div class="div_design">

                <label>Product Description</label>
                <input class="text_color"type="text" name="description" placeholder="Write a description" required="" value="{{$product->description}}">
                </div>
                <div class="div_design">

                <label>Product Price</label>
                <input class="text_color"type="number" name="price" placeholder="Write a price" required="" value="{{$product->price}}">
                </div>
                <div class="div_design">

                <label>Discount Price</label>
                <input class="text_color"type="number" name="discount_price" placeholder="Write a discount" value="{{$product->discount_price}}">
                </div>
                <div class="div_design">

                <label>Product Quantity</label>
                <input class="text_color"type="number" name="quantity" placeholder="Enter a quantity" required="" value="{{$product->quantity}}">
                </div>
                <div class="div_design">

                <label>Product Category :</label>
                <select class="text_color" name="category" required="">
                    <option value="{{$product->category}}" selected=""> {{$product->category}}</option>
                    
                    @foreach($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach

                </select>
                </div>
                <div class="div_design">

                <label>Current Product Image Here :</label>
                <img height="250px" width="250px" src="/product/{{$product->image}}">
                </div>
                <div class="div_design">

                <label>Change Product Image Here :</label>
                <input type="file" name="image">
                </div>
                <div class="div_design">
                <input type="submit" value="Update Product" class="btn btn-primary">
                </div>

                </form>
                
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
    <!-- End custom js for this page -->
  </body>
</html>