<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Stripe;
use Session;
use App\Http\Controllers\Charge;
use App\Models\Comment;
use App\Models\Reply;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    public function index()
    {
        $product=Product::paginate(9);
        $comment=comment::orderby('id','desc')->get();
        $reply=reply::all();

        return view('home.userpage',compact('product','comment','reply'));
    }
    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
            $total_product=product::all()->count();
            $total_order=Order::all()->count();
            $total_user=User::all()->count();
            $order=order::all();
            $total_revenue=0;

            foreach($order as $order)
            {
                $total_revenue=$total_revenue + $order->price;
            }

            $total_delivered=order::where('delivery_status','=','delivered')->get()->count();
            $total_pending=order::where('delivery_status','=','pending')->get()->count();
            
            return view('admin.home', compact('total_product','total_order','total_user','total_revenue','total_delivered','total_pending'));

        }
        else
        {
            $product=Product::paginate(9);
            $comment=comment::orderby('id','desc')->get();
            $reply=reply::all();

        return view('home.userpage',compact('product','comment','reply'));
        }
    }
    public function product_details($id)
    {
        $product=Product::find($id);
        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user=Auth::user();

            $userid=$user->id;

            $product=Product::find($id);

            $product_exist_id=Cart::where('product_id', '=', $id)->where('user_id', '=', $user->id)->get('id')->first();

            if($product_exist_id)
            {
                $cart=Cart::find($product_exist_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $request->quantity;

                if($product->discount_price!=null)
                {
                    $cart->price=$product->discount_price * $cart->quantity;
                }
                else
                {
                    $cart->price=$product->price * $cart->quantity;
                }

                $cart->save();

                Alert::success('Done', 'Product Added to Cart' );

                return redirect()->back();
            }
            else
            {
                $cart=new Cart;
            
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;

            $cart->product_title=$product->title;
            $cart->quantity=$request->quantity;

            if($product->discount_price!=null)
            {
                $cart->price=$product->discount_price * $request->quantity;
            }
            else
            {
                $cart->price=$product->price * $request->quantity;
            }
            
            $cart->image=$product->image;
            $cart->product_id=$product->id;

            $cart->save();

            Alert::success('Done', 'Product Added to Cart' );

                return redirect()->back();

            }

            $cart=new Cart;
            
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;

            $cart->product_title=$product->title;
            $cart->quantity=$request->quantity;

            if($product->discount_price!=null)
            {
                $cart->price=$product->discount_price * $request->quantity;
            }
            else
            {
                $cart->price=$product->price * $request->quantity;
            }
            
            $cart->image=$product->image;
            $cart->product_id=$product->id;

            $cart->save();

            Alert::success('Done', 'Product Added to Cart' );

            return redirect()->back();


        }
        else
        {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $cart=Cart::where('user_id',$id)->get();
            return view('home.showcart',compact('cart'));
        }
        else
        {
            return redirect('login');
        }
        
    }
    public function remove_cart($id)
    {
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message','Product Removed from Cart Successfully');
    }
    public function cash_order()
    {
        $user=Auth::user();
        $userid=$user->id;
        $data=Cart::where('user_id','=',$userid)->get();

        foreach($data as $data)
        {
            $order=new Order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->quantity=$data->quantity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->product_id=$data->product_id;

            $order->payment_status='cash on delivery';
            $order->delivery_status='pending';
            $order->save();

            $cart_id=$data->id;

            $cart=Cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->with('message','We have recieved your order and will contact you soon.Thankyou...');
    }
    public function stripe($totalprice)
    {
    // Set your Stripe publishable key
    $stripeKey = config('services.stripe.key');

    return view('home.stripe', compact('totalprice', 'stripeKey'));
    }
    public function stripePost(Request $request,$totalprice)

    {

        
        Stripe\Stripe::setApiKey('sk_test_51NxXMzFgQj38eJuEGSGKGrtmDKFnHlDxa8xikYeGUqX7zo6APyuQROnEP2Z8pT95oWvvwvuM33PrhSAzGPgTWmSp00NULi8R2q');

    

        Stripe\Charge::create ([

                "amount" => $totalprice * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Thanks for payment" 

        ]);

        $user=Auth::user();
        $userid=$user->id;
        $data=Cart::where('user_id','=',$userid)->get();

        foreach($data as $data)
        {
            $order=new Order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->quantity=$data->quantity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->product_id=$data->product_id;

            $order->payment_status='paid';
            $order->delivery_status='pending';
            $order->save();

            $cart_id=$data->id;

            $cart=Cart::find($cart_id);
            $cart->delete();
        }

      

        Session::flash('success', 'Payment successful!');

              

        return back();

    }
    public function show_order()
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $order=Order::where('user_id','=',$userid)->get();
            return view('home.order', compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }
    public function cancel_order($id)
    {
        $order=Order::find($id);
        $order->delivery_status='you cancelled this order';
        $order->save();
        
        return redirect()->back()->with('message','Order Cancelled Successfully');
    }
    public function add_comment(Request $request)
    {
        if(Auth::id())
        {
            $comment=new Comment;
            $comment->name=Auth::user()->name;
            $comment->user_id=Auth::user()->id;
            $comment->comment=$request->comment;
            $comment->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function add_reply(Request $request)
    {
        if(Auth::id())
        {
            $reply=new reply;
            $reply->name=Auth::user()->name;
            $reply->user_id=Auth::user()->id;
            $reply->comment_id=$request->commentId;
            $reply->reply=$request->reply;
            $reply->save();
            return redirect()->back();


        }
        else
        {
            return redirect('login');
        }
    }

    public function product_search(Request $request)
    {
        $comment=comment::orderby('id','desc')->get();
        $reply=reply::all();

        $search_text=$request->search;
        $product=Product::where('title','LIKE',"%$search_text%")->orwhere('category','LIKE',"%$search_text%")->paginate(9);

        return view('home.userpage',compact('product','comment','reply'));

    }
    public function product()
    {
        $product=Product::paginate(9);
        $comment=comment::orderby('id','desc')->get();
        $reply=reply::all();
        return view('home.all_product',compact('product','comment','reply'));
    }
    public function search_product(Request $request)
    {
        $comment=comment::orderby('id','desc')->get();
        $reply=reply::all();

        $search_text=$request->search;
        $product=Product::where('title','LIKE',"%$search_text%")->orwhere('category','LIKE',"%$search_text%")->paginate(9);

        return view('home.all_product',compact('product','comment','reply'));

    }
    
}
