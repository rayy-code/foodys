<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    //index
    public function index(){

    }

    //function untuk ke halaman form makanan baru
    public function create(){

        //mengambil data kategori
        $categories = Category::all();

        //ke halaman form makanan baru
        return view('makanan.create',["categories"=>$categories]);
    }

    /**
     * Function untunk menambahkan data menu
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validasi inputan
        $validate = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image'=> 'required|image|mimes:png,jpg,jpeg|max:2048',
            'category_id'=> 'required|exists:categories,id'
        ]);

        
        //menyimpan gambar
        $imgItem = $request->file('image');
        if($imgItem){
            $imgItem->storeAs('public/images/menu', $imgItem->hashName());
        }

        //menyimpan kedalam database
        MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imgItem ? $imgItem->hashName() : null,
            'category_id' => $request->category_id
        ]);

        //membuat sesi flash
        session()->flash('success', 'Data menu berhasil ditambahkan');

        //kembali ke halaman index
        return redirect()->route('admin.dashboard');
    }

    //function untuk pergi ke halaman update
    public function edit($id){
        //mengambil data menu
        $menu = MenuItem::findOrFail($id);
        //mengambil data kategori
        $categories = Category::all();
        //mengembalikan halaman update
        return view('makanan.update',["menu"=>$menu,"categories"=>$categories]);
    }

    //function untuk mengupdate data menu
    public function update(Request $request, $id){
        //validasi inputan
        $validate = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image'=> 'image|mimes:png,jpg,jpeg|max:2048',
            'category_id'=> 'required|exists:categories,id'

        ]);
        $imgItem = $request->file('image');
        $menu = MenuItem::findOrFail($id);
        if($imgItem){
            //menghapus gambar lama
            Storage::delete('public/images/menu/'.$menu->image);
            //menyimpan gambar baru
            $imgItem->storeAs('public/images/menu', $imgItem->hashName());

        }else{
            $imgItem = null;
        }
        //mengupdate data menu
        MenuItem::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imgItem ? $imgItem->hashName() : $menu->image,
            'category_id' => $request->category_id
        ]);

        //membuat sesi flash
        session()->flash('success', 'Data menu berhasil diupdate');
        //kembali ke halaman index
        return redirect()->route('admin.dashboard');
    }

    //function untuk menghapus data menu
    public function destroy($id){
        //mengambil data menu
        $menu = MenuItem::findOrFail($id);
        //menghapus gambar
        Storage::delete('public/images/menu/'.$menu->image);
        //menghapus data menu
        MenuItem::destroy($id);
        //membuat sesi flash
        session()->flash('success', 'Data menu berhasil dihapus');
        //kembali ke halaman index
        return redirect()->route('admin.dashboard');
    }

    //function untuk customer untuk ke halaman detail menu
    public function show($id){

        //mengambil data makanan berdasarkan id
        $menu = MenuItem::findOrFail($id);

        //ke halaman detail makanan
        return view('customer.show', ['menu'=>$menu]);
    }

    //function untuk search makanan
    public function search(Request $request){

        //mengambil kata kunci yang dikirm
        $key = $request->q;

        //mengambil data berdasarkan kata kunci
        $menu = MenuItem::where('name', 'like', '%' . $key . '%')->paginate(20);

        //menampilkan halaman homepage
        return view('homepage', ['foods'=>$menu, 'key'=>$key]);
    }
}