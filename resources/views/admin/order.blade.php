<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .title_deg{
            text-align: center;
            font-size: 40px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .table_deg
        {
            border: 2px solid white;
            width: 100%;
            margin:auto;
            padding-top:50px ;
            text-align: center;
        }
        .th_deg{
            padding: 30px;
            margin: 20px;
            border-right: white solid 2px;
            border-bottom: white solid 2px;
            background-color: lightgray;

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
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">

            <h1 class="title_deg">All Orders</h1>

            <div>

                @if(session('message'))
                <p class="alert alert-success">
                    {{session('message')}}
                </p>
                @endif



            </div>

            <div style=" padding-bottom: 30px; text-align: center; padding-left: 400px;">
                <form action="{{url('search')}}" method="get">
                    @csrf
                
                <input type="text" name="search" placeholder="enter text to search" style="color: black;"> 
                <input type="submit" name="submit" value="Search" class="btn btn-outline-primary">


            </div>

            <table  class="table_deg" >
                <tr class="th_deg">
                    <th class="th_deg">Order date</th>
                    <th class="th_deg">Name</th>
                    <th class="th_deg">Email</th>
                    <th class="th_deg">Address</th>
                    <th class="th_deg">Phone</th>
                    <th class="th_deg">Product title</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Payment status</th>
                    <th class="th_deg">Delivery status</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Delivered</th>
                    <th class="th_deg">Print PDF</th> 
                    <th class="th_deg">Send Email</th>

                </tr>

                @forelse($order as $order)

                <tr>
                    <td class="td_deg">{{$order->created_at}}</td>
                    <td class="td_deg">{{$order->name}}</td>
                    <td class="td_deg">{{$order->email}}</td>
                    <td class="td_deg">{{$order->address}}</td>
                    <td class="td_deg">{{$order->phone}}</td>
                    <td class="td_deg">{{$order->product_title}}</td>
                    <td class="td_deg">{{$order->price}}</td>
                    <td class="td_deg">{{$order->payment_status}}</td>
                    <td class="td_deg">{{$order->delivery_status}}</td>
                    <td class="td_deg"><img src="{{asset('product/'.$order->image)}}" style="height: 150px; width: 100px;"></td>
                    <td class="td_deg">
                        @if($order->delivery_status=='pending')
                        <a href="{{url('delivered',$order->id)}}" onclick="return confirm ('Are you sure this product has been delivered !!!')" class="btn btn-primary">Delivered</a>
                        @else
                        <p style="color: green;">Delivered</p>
                        @endif
                    </td>
                    <td class="td_deg">
                        <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">Print PDF</a>
                    </td>
                    <td class="td_deg">
                        <a href="{{url('send_email',$order->id)}}" class="btn btn-info">Send Email</a>
                    </td>


                </tr>

                @empty
                <tr>
                    <td colspan="16">
                    Sorry. No data matching your query was found !
                    </td>
                </tr>
                
                @endforelse
            </table>


            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
    <!-- End custom js for this page -->
  </body>
</html>