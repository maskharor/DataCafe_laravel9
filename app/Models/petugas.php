<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petugas extends Model
{
    use HasFactory;
    public $timestamps=null;
    protected $table="petugas";
    protected $primarykey="id_user";
    protected $fillable=['nama_petugas','username','role','password'];
}
