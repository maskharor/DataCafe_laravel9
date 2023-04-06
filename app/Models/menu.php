<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;
    public $timestamps=null;
    protected $table="menus";
    protected $primarykey="id_menu";
    protected $fillable=['nama_menu','type','desc','gambar','price'];

}
