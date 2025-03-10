<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\MenuItem;
use Barryvdh\DomPDF\PDF;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    //function untuk melihat pesanan user
    public function index(){

        //mnegambil data order berdasarkan user
        $orders = Order::where('user_id','=',Auth::user()->id)->where('status','!=', 'done')->orderBy("created_at","desc")->get();

        //ke halaman order user
        return view('customer.order',['orders'=> $orders]);
    }

    //function memasukkan order baru
    public function store(Request $request)
    {
        //mengambil data di keranjang berdasarkan user
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();

        //membuat order baru
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => 0,
            'status' => 'pending',
        ]);

        //inisiasi total harga
        $totalPrice = 0;

        //memasukkan data detail order dengan looping
        foreach ($cartItems as $cartItem) {
            OrderDetail::create([
                'order_id' => $order->id,
                'menu_item_id' => $cartItem->menu_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->menu->price * $cartItem->quantity,
            ]);


            //mengubah total harga
            $totalPrice += $cartItem->menu->price * $cartItem->quantity;
        }

        //mengubah total harga order
        $order->update(['total_price' => $totalPrice]);

        // Hapus data dari cart_items
        Cart::where('user_id', Auth::user()->id)->delete();

        //kembali ke halaman order customer
        return redirect()->route('customer.order.index')->with('success', 'Order placed successfully!');
    }

    //fungsi untuk menampilkan pesanan customer
    public function show(){

        //mengambil data order berdasarkan user
        $order = Order::where('user_id','=',Auth::user()->id)->get();

        //ke halaman pesanan customer
        return view('customer.order',['orders'=> $order]);
    }

    //function untuk mengupdate status order
    public function update(Request $request, $id)
    {

        //mengambil data order berdasarkan id
        $order = Order::find($id);

        //mengupdate status order
        switch ($order->status) {
            case 'pending':

                //mengubah status dari pending ke process
                $order->update(['status' => 'process']);
                break;

            case 'process':

                //mengubah status dari process ke done
                $order->update(['status' => 'done']);

                break;

            default:
                # code...
                break;
        }

        //membuat sesi pemberitahuan
        session()->flash('success', 'Order status updated successfully!');

        //kembali ke halaman order
        return redirect()->route('admin.orders.index');
    }

    //function untuk melihat riwayat pesanan
    public function history()
    {
        //mengecek apakah login sebagai admin atau customer
        if(Auth::user()->role == 'admin'){
            //mengambil data order berdasarkan admin
            $orders = Order::orderBy('created_at','desc')->paginate(20);

        }else{
            //mengambil data order berdasarkan user
            $orders = Order::where('user_id','=',Auth::user()->id)->orderBy('created_at','desc')->paginate(20);
        }

        return view('history.index',['orders'=> $orders]);
    }

    //function untuk generate pdf
    public function generatePdf()
    {
        $orders = Order::orderBy('created_at','desc')->get();

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pdf.template', ['orders' => $orders, 'title'=>'Riwayat Pesanan']);


        return $pdf->stream('history.pdf');
    }

    //function untuk melakukan pembayaran
    public function payment(){
        //mengambil data order berdasarkan id user
        $order = Cart::where('user_id','=',Auth::user()->id)->get();

        //menampilkan halaman pembayaran
        return view('customer.payment',['carts'=>$order]);
    }

}
