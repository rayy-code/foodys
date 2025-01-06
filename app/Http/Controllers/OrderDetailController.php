<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    //function untuk mengambl data order detail
    public function index(){

        //mengambil data dari table OrderDetail
        $orders = OrderDetail::orderBy("id","desc")->get();
        
        //memfilter hanya pesanan yang status nya selain "selesai"
        $procesOrder = Order::where('status','!=','done')->paginate(10);

        //menampilkan halaman data order detail
        return view("admin.orders-admin",["pesanan" => $procesOrder]);
    }
}
