<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class kategoriController extends Controller
{
 public function index(){
    return view('kategori/datakategori',["judul" => "Halaman Kategori","kategori"=>Kategori::all()]);
 }
 public function editV(Request $request, $id){
   $kategori = Kategori::find($id);
    // dd($kategori);
   return view('kategori/editkategori',['judul'=>'Edit Data kategori'],compact('kategori'));
 }

 
   public function store(Request $request)
   {
       $request->validate([
           'namakategori' => ['required', 'string', 'max:255'],
       ]);

       Kategori::create([
           'nama_kategori' => $request->namakategori,
       ]);
       return redirect('/datakategori')->with('success', 'Data berhasil di tambahkan');
   
 }

 public function edit(Request $request,$id){

  $validator = Validator::make($request->all(),[
  'nama_kategori' => 'required',
  ]);

  if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

  $data['nama_kategori'] = $request->nama_kategori;

  Kategori::find($id)->update($data);

   return redirect('/datakategori')->with('success', 'Data berhasil di ubah');
}

public function delete(string $id){
  $kategori = Kategori::where('id_kategori',$id)->delete();

  if (!$kategori) {
      return redirect()->back();
  }
  return redirect('/datakategori')->with('success','data berhasil di hapus!');
}
}
