<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Post;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function index(){
        return view('userdata/userdata',['judul'=>'Data User','user'=>User::all()]);
    }

    public function editV($id){
        $user = User::find($id);
        
        return view('userdata/edituser',[
            'judul'=>'Edit Data User',
        ],compact('user'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'bidang' => ['required','string'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'bidang' =>$request->bidang,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        return redirect('/userdata')->with('success', 'Data berhasil di tambahkan');
    }

    public function edit(Request $request,$id){

        $user = User::find($id);

        // $user->password = Hash::make('password');
        
        $user->update($request->all());

        return redirect('/userdata')->with('success','data berhasil di ubah');
    }

    public function editpass(Request $request,$id)
    {
        
        // $request->user()->update(['password' => Hash::make(['password'])
        //     ]);
        
        $user = User::find($id);

        $user->password = Hash::make('password');
        
        $user->update($request->all());

        return redirect('/userdata')->with('success', 'Password berhasil di ubah');
    }

    public function deleteuser(string $id){
        $user = User::where('id',$id)->delete();

        if (!$user) {
            return redirect()->back();
        }
        return redirect('/userdata')->with('success','data berhasil di hapus!');
    }
}
