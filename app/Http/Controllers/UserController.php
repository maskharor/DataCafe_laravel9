<?php

namespace App\Http\Controllers;

use App\Models\petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class UserController extends Controller
{
    public function getuser(){
        $dt_user=petugas::get();
        return response()->json($dt_user);
    }
    public function getuserid(Request $req, $id){
        $dt_user=petugas::where('id_user', $id)
        ->get();
        return response()->json($dt_user);
    }
    public function createuser(Request $req){
        $validator = validator::make($req->all(),[
            'nama_petugas'=>'required',
            'username'=>'required',
            'role'=>'required',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $save=petugas::create([
            'nama_petugas' =>$req->get('nama_petugas'),
            'username' =>$req->get('username'),
            'role' =>$req->get('role'),
            'password' =>$req->get('password'),
        ]);
        if($save){
            return Response()->json([
                'status'=>true, 'message' => 'Success Menambah User'
            ]);
        }
        else{
            return Response()->json([
                'status'=>false, 'message' => 'Gagal Menambah User'
            ]);
        }
    }
    public function updateuser(Request $req, $id){
        $validator = validator::make($req->all(),[
            'nama_petugas'=>'required',
            'username'=>'required',
            'role'=>'required',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->tojson()); 
        }
        $ubah=petugas::where('id_user', $id)->update([
            'nama_petugas' =>$req->get('nama_petugas'),
            'username' =>$req->get('username'),
            'role' =>$req->get('role'),
            'password' =>$req->get('password'),
        ]);
        if($ubah){
            return Response()->json([
                'status' =>true, 'message' => 'Sukses Mengubah User'
            ]);
        }
        else{
            return Response()->json([
                'status' => false, 'message' => 'Gagal Mengubah User'
            ]);
        }
    }
    public function deleteuser($id){
        $hapus=petugas::where('id_user', $id)->delete();
        if($hapus){
            return Response()->json([
                'status' =>true, 'message' => 'Sukses Menghapus User'
            ]);
        } 
        else{
            return Response()->json([
                'status' =>true, 'message' => 'Gagal Menghapus User'
            ]);
        } 
    }
}
