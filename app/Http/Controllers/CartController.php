<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //function untuk melihat semua data yang ada dikeranjang
    public function index(){

        //mengambil data kerjanjang sesuai user
        $cart = Cart::where("user_id",Auth::user()->id)->orderBy("id","desc")->get();

        //ke halaman kerjanjang saya
        return view('customer.cart',['carts'=> $cart]);
    }

    //function untuk memasukkan data baru ke keranjang
    public function store(Request $request, $menu_id){

        //validasi inputan
        $validate = $request->validate([
            'quantity' => 'required|numeric',
        ]);

        //mengambil data dengan user_id dan menu_id yang sama
        $cart = Cart::where('user_id', Auth::user()->id)->where('menu_id', $menu_id)->first();

        //mengecek apakah ada data yang sama atau tidak
        if($cart){
            //jika sudah ada, maka update data

            $lastQty = $cart->quantity;
            $cart->update([
                'quantity' => $lastQty + $request->quantity
            ]);

        }else{
            //jika belum ada maka simpan data baru

            //menambahkan data baru kedalam keranjang
            Cart::create([
                'user_id' => Auth::user()->id,
                'quantity'=> $request->quantity,
                'menu_id'=> $menu_id,
            ]);
        }
        
        //membuat sesi pemberitahuan
        session()->flash('success', 'Data Berhasil Ditambahkan');

        //kembali kehalaman detail makanan
        return redirect('/menu/'.$menu_id);
    }

    //function untuk menghapus data di cart
    public function destroy(Request $request, $id){
        //menghapus data di keranjang
        Cart::destroy($id);
        //membuat sesi pemberitahuan
        session()->flash('success', 'Data Berhasil Dihapus');
        //kembali kehalaman keranjang
        return redirect('/cart');
    }
}
