<?php

namespace App\Http\Controllers;

use App\Models\meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class MejaController extends Controller
{
    public function getmeja(){
        $dt_meja=meja::get();
        return response()->json($dt_meja);
    }
    public function getmejaid(Request $req, $id){
        $dt_meja=meja::where('id_meja', $id)
        ->get();
        return response()->json($dt_meja);
    }
    public function createmeja(Request $req){
        $validator = validator::make($req->all(),[
            'nomor_meja'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        $save=meja::create([
            'nomor_meja' =>$req->get('nomor_meja'),
            'status' =>'kosong',
        ]);
        if($save){
            return Response()->json([
                'status'=>true, 'message' => 'Success Menambah Meja'
            ]);
        }
        else{
            return Response()->json([
                'status'=>false, 'message' => 'Gagal Menambah Meja'
            ]);
        }
    }
    public function updatemeja(Request $req, $id){
        $validator = validator::make($req->all(),[
            'nomor_meja'=>'required',
            'status'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->tojson()); 
        }
        $ubah=meja::where('id_meja', $id)->update([
            'nomor_meja' =>$req->get('nomor_meja'),
            'status' =>$req->get('status'),
        ]);
        if($ubah){
            return Response()->json([
                'status' =>true, 'message' => 'Sukses Mengubah Meja'
            ]);
        }
        else{
            return Response()->json([
                'status' => false, 'message' => 'Gagal Mengubah Meja'
            ]);
        }
    }
    public function deletemeja($id){
        $hapus=meja::where('id_meja', $id)->delete();
        if($hapus){
            return Response()->json([
                'status' =>true, 'message' => 'Sukses Menghapus Meja'
            ]);
        } 
        else{
            return Response()->json([
                'status' =>true, 'message' => 'Gagal Menghapus Meja'
            ]);
        } 
    }
}
