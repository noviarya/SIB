<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

date_default_timezone_set('Asia/Jakarta');

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return view('admin.master.user.user', compact('user'));
    }
    
    public function store(Request $request)
    {
        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'level'     => $request->level,
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        return redirect('/user')->width('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        $user = user::find($id);
        
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password  = Hash::make($request->password);
        $user->level     = $request->level;
        $user->updated_at= date('Y-m-d H:i:s');
 
        $user->save();

        return redirect('/user')->width('success', 'Data Berhasi Diubah');
    }

    public function destroy($id)
    {
        $user = User::find($id);
 
        $user->delete();

        return redirect('/user')->width('success', 'Data Berhasil Dihapus');
    }
}
