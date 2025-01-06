<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //function untuk mengambil semua data customer
    public function index(){

        //mengambil data semua customer
        $customers = Customer::all();

        return view('');
    }

    //function untuk mengambil data customer berdasarkan id
    public function show($id_customer)
    {
        //mengambil data customer
        $customer = Customer::find($id_customer);

        return view('');
    }

    //function untuk mengambil data customer sebagai customer
    public function profile(){
        //mengambil data customer
        $customer = Customer::where('user_id','=',Auth::user()->id)->first();

        //ke halaman profile
        return view('customer.profile',['customer'=>$customer]);
    }

    //function untuk mengupdate data customer
    public function update(Request $request, $id_customer){
        //mengambil data customer
        $customer = Customer::find($id_customer);

        $validate = $request->validate([
            'name'=> 'required',
            'img_profile' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $profile = $request->file('img_profile');

        if($profile){
            $profile->storeAs('public/images/profile',$profile->hashName());
        }
        
        $user = User::find($customer->user_id);

        $user->update([
            'name' => $request->name,
        ]);

        //update data customer
        $customer->update([
            'img_profile' => $profile ? $profile->hashName() : $customer->img_profile,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        //membuat session pemberitahuan
        session()->flash('success','Data customer berhasil diupdate');

        //redirect ke halaman profile
        return redirect()->route('customer.profile.index');
    }
}
