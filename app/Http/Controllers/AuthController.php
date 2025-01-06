<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MenuItem;
use App\Models\Customer;
use App\Models\Order;

class AuthController extends Controller
{

    //function untuk ke halaman register
    public function register_page(){

        //mengecek apakah ada sesi login
        $user = Auth::user();

        if($user){
            //jika ada, kembali ke halaman home
            return redirect()->route('user.home');
        }else{

            //ke halaman register
            return view('auth.register');
        }
    }

    //function ke halaman login
    public function login_page()
    {
        //mengecek apakah ada sesi login
        $user = Auth::user();
        if($user){
            //jika ada, kembali ke halaman home
            return redirect()->route('user.home');
        }else{
            //ke halaman login
            return view('auth.login');
        }
    }

    //function untuk register
    public function register(Request $request)
    {
        //validasi inputan
        $validator = $request->validate([
            "email"=> "required|email|unique:users,email",
            "password"=> "required|min:8|confirmed",
            "name"=> "required|min:4",
        ]);

        //membuat user / customer baru
        $user = User::create([
            "email"=> $request->email,
            "password"=> Hash::make($request->password),
            "name"=> $request->name,
            "role" => "customer"
        ]);

        //menambahkan data customer
        Customer::create([
            "user_id" => $user->id,
        ]);

        //mengatur informasi
        session()->flash("success","Berhasil mendaftar, silahkan login");

        //masuk ke halaman login
        return redirect()->route('user.home');

    }


    //function untuk login
    public function login(Request $request){

        //validasi inputan dari user
       $validate = $request->validate([
        "email"=> "required|email|exists:users,email",
        "password"=> "required|min:8",
       ]);

       //membuat variabel kredensial
       $credentials = $request->only("email","password");       

       //melakukan login
       $user = Auth::attempt($credentials);

       //mengecek user
       if ($user) {

        //membuat flash message
        session()->flash("success","Selamat datang, Anda berhasil login");

        //ke halaman home
        return redirect()->route('admin.dashboard');
       }else{
        //membuat sesi pemberitahuan
        session()->flash('error','Password tidak sesuai');

        //kembali ke halaman login
        return redirect()->route('login');
       }
    }

    //function untuk logout
    public function logout(Request $request){

        //menghapus sesi login
        Auth::logout();

        //kembali ke halaman login
        return redirect()->route('user.home');
    }

    //function unutk ke halaman home
    public function home(){

        //periksa apakah login sebagai admin atau bukan
        if(Auth::user()) {
            if(Auth::user()->role == 'admin') {

                //ke halaman dashboard admin
                return redirect()->route('admin.dashboard');
            }else{

                //mengambil data makanan
                $makanan = MenuItem::paginate(20);
        
                //menampilkan halaman home
                return view("homepage",['foods'=>$makanan]);
            }
        }else{

        //mengambil data makanan
        $makanan = MenuItem::paginate(20);

        //menampilkan halaman home
        return view("homepage",['foods'=>$makanan]);
        }
    }

    //function 
    public function index(){

        //mengambil data makanan
        $menu = MenuItem::orderBy("name","asc")->paginate(20);

        //menghitung total pendapatan pada tabel order
        $total = Order::sum('total_price');

        //menampilkan halaman index
        return view("admin.dashboard",['makanan'=>$menu, 'revenue'=>$total]);
    }
}
