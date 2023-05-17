<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\menu;
use App\Models\meja;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class TransaksiController extends Controller
{
    //function memanggil semua data transaksi
    public function tampil(){
        $data=transaksi::get();
        return response()->json($data);
    }

    public function gethistory(){
        $get = DB::table('history')->get();
        return response()->json($get);
    }
    public function selecthistory($code){
        $get = DB::table('transaksis')
        ->where('id_keranjang',$code)
        ->join('petugas','transaksi.id_user','=','petugas.id_user')
        ->join('menus','transaksi.id_menu','=','menus.id_menu')
        ->get();
        return response()->json($get);
    }

    // data transaksi fase proses 
    public function ongoing(){
        $get = meja::where('status', 'digunakan')->get();
        return response()->json($get);
    }
    public function getongoingtransaksi($id){
        $gettransaksi = transaksi::where('id_meja', $id)
        ->where('status', 'belum_lunas')
        ->first();
        return response()->json($get);
    }
    public function totalharga($id){
        $gettotal = transaksi::where('id_meja', $id)
        ->where('status', 'belum_lunas')
        ->sum('total_harga');
        return response()->json($gettotal);
    }
    public function getcart(){
        $cart = transaksi::where('id_meja', $id)
        ->join('menus', 'transaksis.id_menu', '=', 'menus.id_menu')
        ->get();
        return response()->json($cart);
    }

    public function selecttransaksi($id){
        $gettransaksi = transaksi::where('id_keranjang', $id)
        ->get();
        return response()->json($gettransaksi);
    }
    // create transaksi
    public function createtransaksi(Request $req){
        $harga_menu = DB::table('menus')
        ->where('id_menu', $req->input('id_menu'))
        ->select('price')
        ->first();
        $harga_menu = $harga_menu->price;

        $tgl_pesan=carbon::now();
        $total_pesanan = $req->input('total_pesanan');
        $total_harga = $harga_menu * $total_pesanan;
        
        $tambah=transaksi::create([
            
            'id_menu'=>$req->input('id_menu'),
            'tgl_pesan'=> $tgl_pesan,
            'total_pesanan'=>$total_pesanan,
            'total_harga'=>$total_harga,
            'status'=>'belum_bayar',
        ]);
        if($tambah){
            return Response()->json([
                'status'=>true, 'message' => 'Sukses Memesan Menu'
            ]);
        }
        else{
            return Response()->json([
                'status'=>false, 'message' => 'Gagal Memesan Menu'
            ]);
        }
    }
    
    // checkout transaksi
    public function checkout(Request $req){
        $id_keranjang = Str::random(5);

        $id_user =$req->input('id_user');
        $checkout = transaksi::where('id_keranjang', null)->update([
            'id_keranjang' => $id_keranjang,
            'id_user' => $id_user,
            'id_meja' =>$req->input('id_meja'),
            'nama_pelanggan' => $req->input('nama_pelanggan')
        ]);

        $history = DB::table('history')->insert([
            'id_keranjang' => $id_keranjang, 
            'tgl_transaksi' => carbon::now(),
            'id_user' => $req->input('id_user'), 
            'nama_pelanggan' => $req->input('nama_pelanggan')
        ]);

        $updatemeja = meja::where('id_meja', $req->input('id_meja'))->update([
            'status' => 'digunakan'
        ]);

        if($checkout && $updatemeja){
            return Response()->json([
                'status'=>true, 'message' => 'Sukses'
            ]);
        }
        else{
            return Response()->json([
                'status'=>false, 'message' => 'Gagal'
            ]);
        }
    }

    public function transaksidone($id){
        $done = transaksi::where('id_meja', $id)
        ->where('status', 'belum_lunas') 
        ->update(['status' => 'lunas' ]);
        
        $meja = meja::where('id_meja', $id)
        ->update(['status' => 'kosong' ]);

        if($done && $meja){
            return Response()->json([
                'status'=>true, 'message' => 'Sukses'
            ]);
        }
        else{
            return Response()->json([
                'status'=>false, 'message' => 'Gagal'
            ]);
        }
    }
}
