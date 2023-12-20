<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Notifications\Notification;
use PDF;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function view_category()
    {
        if(Auth::id())
        {
            $data=Category::all();
        
            return view('admin.category',compact('data'));
        }
        else
        {
            return redirect('login');
        }
        
    }
    public function add_category(Request $request)
    {
        
        if(Auth::id())
        {
            $data=new Category;
            $data->category_name=$request->category;
            $data->save();
            return redirect()->back()->with('message','Category Added Successfully');
        }
        else
        {
            return redirect('login');
        }



    }

    public function delete_category($id)
    {
        if(Auth::id())
        {
            $data=Category::find($id);
            $data->delete();
            return redirect()->back()->with('message','Category Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }
    }   

    public function view_product()
    {
        if(Auth::id())
        {
            $category=category::all();
            return view('admin.product',compact('category'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function add_product(Request $request)
    {
        if(Auth::id())
        {
            $product=new Product;
            $product->title=$request->title;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->discount_price=$request->discount_price;
            $product->quantity=$request->quantity;
            $product->category=$request->category;
            
            $product->image=$request->image;
            $image=$request->image;
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image=$imagename;
            $product->save();
        }
        else
        {
            return redirect('login');
        }


        return redirect()->back()->with('message','Product Added Successfully');
    }

    public function show_product()
    {
        if(Auth::id())
        {
            $product=Product::all();
            return view('admin.show_product',compact('product'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function delete_product($id)
    {
        if(Auth::id())
        {
            $product=Product::find($id);
            $product->delete();
            return redirect()->back()->with('message','Product Deleted Successfully');
        }
        else
        {
            return redirect('login');
        }
    }

    public function update_product($id)
    {
        if(Auth::id())
        {
            $product=product::find($id);
            $category=category::all();
            return view('admin.update_product',compact('product','category'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function update_product_confirm(Request $request,$id)
    {
        if(Auth::id())
        {
            $product=Product::find($id);
            $product->title=$request->title;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->discount_price=$request->discount_price;
            $product->quantity=$request->quantity;
            $product->category=$request->category;
            
            $image=$request->image;
            if($image)
            {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image=$imagename;
            }
            $product->save();
            return redirect()->back()->with('message','Product Updated Successfully');
        }
        else
        {
            return redirect('login');
        }
    }
    public function order()
    {
        if(Auth::id())
        {
            $order = order::all();
            return view('admin.order', compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function delivered($id)
    {
        if(Auth::id())
        {
            $order = order::find($id);
            $order->delivery_status = 'delivered';
            $order->payment_status = 'paid';
            $order->save();
            return redirect()->back()->with('message','Order Delivered Successfully');
        }
        else
        {
            return redirect('login');
        }
    }
    public function print_pdf($id)
    {
        if(Auth::id())
        {
            $order=order::find($id);
            $pdf = PDF::loadView('admin.pdf',compact('order'));
            return $pdf->download('order_details.pdf');
        }
        else
        {
            return redirect('login');
        }
    }

    public function send_email($id)
    {
        if(Auth::id())
        {
            $order=order::find($id);
            return view('admin.email_info',compact('order'));
        }
        else
        {
            return redirect('login');
        }

    }
    public function send_user_email(Request $request,$id)
    {
        if(Auth::id())
        {
            $order=order::find($id);
            $details=[
                'greeting'=>$request->greeting,
                'firstline'=>$request->firstline,
                'body'=>$request->body,
                'button'=>$request->button,
                'url'=>$request->url,
                'lastline'=>$request->lastline,
            ];
            $order->notify(new SendEmailNotification($details));
            return redirect()->back()->with('message','Email Sent Successfully');
        }
        else
        {
            return redirect('login');
        }
    }
    
    public function searchdata(Request $request)
    {
        if(Auth::id())
        {
            $search=$request->search;
            $order=order::where('name','LIKE', "%{$search}%")->orwhere('email','LIKE', "%{$search}%")->orwhere('address','LIKE', "%{$search}%")->orwhere('phone','LIKE', "%{$search}%")->orwhere('product_title','LIKE', "%{$search}%")->orwhere('price','LIKE', "%{$search}%")->orwhere('payment_status','LIKE', "%{$search}%")->orwhere('delivery_status','LIKE', "%{$search}%")->get();
            return view('admin.order',compact('order'));
        }
        else
        {
            return redirect('login');
        }


        
    }
    
}
