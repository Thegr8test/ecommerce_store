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
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              {{Session()->get('message')}}
            </div>
            @endif
            
            <div class="div_center">
                <h1 class="font_size">Add product</h1>

                <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="div_design">

                <label>Product Title</Title></label>
                <input class="text_color"type="text" name="title" placeholder="Write a title" required="">
                </div>
                <div class="div_design">

                <label>Product Description</label>
                <input class="text_color"type="text" name="description" placeholder="Write a description" required="">
                </div>
                <div class="div_design">

                <label>Product Price</label>
                <input class="text_color"type="number" name="price" placeholder="Write a price" required="">
                </div>
                <div class="div_design">

                <label>Discount Price</label>
                <input class="text_color"type="number" name="discount_price" placeholder="Write a discount">
                </div>
                <div class="div_design">

                <label>Product Quantity</label>
                <input class="text_color"type="number" name="quantity" placeholder="Enter a quantity" required="">
                </div>
                <div class="div_design">

                <label>Product Category</label>
                <select class="text_color" name="category" required="">
                    <option value="" selected="">Add a category here</option>
                    @foreach($category as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="div_design">

                <label>Product Image Here :</label>
                <input type="file" name="image" required="">
                </div>
                <div class="div_design">
                <input type="submit" value="Add Product" class="btn btn-primary">
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