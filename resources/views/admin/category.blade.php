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
        .h2_font{
            font-size: 40px;
            padding: 40px;
        }
        .input_color{
            background-color: #f2f2f2;
            border: 1px solid #f2f2f2;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
        }
        .center{
            margin: 0 auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid grey;
            border-radius: 5px;
            padding: 10px;
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
            
            @if(Session::has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
              {{Session()->get('message')}}
            </div>
            @endif
            <div class="div_center">
                <h2 class="h2_font">Add Category</h2>
                <form action="{{url('/add_category')}}"method="POST">
                    @csrf
                    <input class="input_color" type="text" name="category" placeholder="Enter Category">
                    <input type="submit" name="submit" value="Add Category" class="btn btn-primary col-md-6">
                </form>
            <div>
                <table class="center">
                    <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                    
                    @foreach($data as $data)

                    <tr>
                        <td>{{$data->category_name}}</td>
                        <td>
                            <a onclick="return confirm('Are you sure you want to delete this category?')" class="btn btn-danger" href="{{url('/delete_category',$data->id)}}">Delete</a>
                        </td>
                    </tr>

                    @endforeach

                </table>
            </div>


            </div>


          </div>
        </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.js')
    <!-- End custom js for this page -->
  </body>
</html>