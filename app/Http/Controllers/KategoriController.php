<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    //index
    public function index(){
        $kategori = Category::all();
        return view('kategori.index',['categories'=> $kategori]);
    }

    //function untuk menambahkan kategori baru
    public function store(Request $request){

        //validasi inputan
        $request->validate([
            'name'=> 'required',
        ]);

        //memasukkan kedalam database
        Category::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'slug'=> Str::slug($request->slug),
        ]);

        //membuat sesi flash
        session()->flash('success','Kategori Berhasil Ditambahkan');

        //kembali ke halaman index
        return redirect()->route('admin.kategori.index');
    }

    //function untuk menghapus kategori
    public function destroy($id)
    {
        //menghapus data
        Category::find($id)->delete();

        //membuat sesi flash
        session()->flash('success','Kategori Berhasil Dihapus');

        //kembali ke halaman index kategori
        return redirect()->route('admin.kategori.index');
    }
}
