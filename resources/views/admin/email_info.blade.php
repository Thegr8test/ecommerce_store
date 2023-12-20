<!DOCTYPE html>
<html lang="en">
  <head>

    <base href="/public">
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">

        label{
            
            display: inline-block;
            width: 200px;
            font-size: 20px;
            font-weight: bold;
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
            <h1 style="text-align: center; font-size: 25px;">Send Email to {{$order->name}} via {{$order->email}}</h1>
            
            <form action="{{url('send_user_email', $order->id)}}" method="post">
                @csrf
            
            <div style= "padding-left: 35%; padding-top: 30px;">
                <label>Email Greetings :</label>
                <input style="color:black;" type="text" name="greeting" >

            
            </div>
            <div style= "padding-left: 35%; padding-top: 30px;">
                <label>Email First-line :</label>
                <input style="color:black;" type="text" name="firstline" >

            
            </div>
            <div style= "padding-left: 35%; padding-top: 30px;">
                <label>Email Body :</label>
                <input style="color:black;" type="text" name="body" >

            
            </div>
            <div style= "padding-left: 35%; padding-top: 30px;">
                <label>Email Button :</label>
                <input style="color:black;" type="text" name="button">

            
            </div>
            <div style= "padding-left: 35%; padding-top: 30px;">
                <label>Email URL :</label>
                <input style="color:black;" type="text" name="url" >

            
            </div>
            <div style= "padding-left: 35%; padding-top: 30px;">
                <label>Email Last-line :</label>
                <input style="color:black;" type="text" name="lastline" >

            
            </div>
            <div style= "padding-left: 35%; padding-top: 30px;">
                
                <input type="submit" value="Send Email" class="btn btn-primary" >

            
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