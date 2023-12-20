<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .center{
            margin:auto;
            width: 50%;
            border: 2px solid white;
            text-align: center ;
            margin-top: 40px;
        }
        .font_size{
            text-align: center;
            font-size: 40px;
            padding: 20px;
        }
        .img_size{
            width: 250px;
            height: 250px;
        }
        .th_color{
            background-color: grey;
            color: white;
        }
        .th_deg{
            padding: 30px;
            margin: 20px;
            border-right: white solid 2px;
            border-bottom: white solid 2px;

        }
        
        .td_deg{
            padding: 30px;
            margin: 20px;
            border-right: white solid 2px;
            border-bottom: white solid 2px;

        }
    </style>

  </head>
  <body>
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
            <h1 class="font_size">Product Catalogue</h1>


            <table class="center">
                    <tr class="th_color">
                        <th class="th_deg">Product Title</th>
                        <th class="th_deg">Product Description</th>
                        <th class="th_deg">Product Price</th>
                        <th class="th_deg">Product Discount Price</th>
                        <th class="th_deg">Product Quantity</th>
                        <th class="th_deg">Product Category</th>
                        <th class="th_deg">Product Image</th>
                        <th class="th_deg">Delete Product</th>
                        <th class="th_deg">Edit Product</th>
                    </tr>

                    @foreach($product as $product)

                    <tr>
                        <td class="td_deg">{{$product->title}}</td>
                        <td class="td_deg">{{$product->description}}</td>
                        <td class="td_deg">{{$product->price}}</td>
                        <td class="td_deg">{{$product->discount_price}}</td>
                        <td class="td_deg">{{$product->quantity}}</td>
                        <td class="td_deg">{{$product->category}}</td>
                        <td class="td_deg">
                            <img class="img_size"src="/product/{{$product->image}}">
                        </td>
                        <td class="td_deg">
                            <a href="{{url('delete_product',$product->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
                        </td>
                        <td class="td_deg">
                            <a href="{{url('update_product',$product->id)}}" class="btn btn-success">Edit</a>
                        </td>

                    </tr>

                    @endforeach
            </table>

        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
    <!-- End custom js for this page -->
  </body>
</html>