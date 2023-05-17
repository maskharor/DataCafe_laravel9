<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meja extends Model
{
    use HasFactory;
    public $timestamps=null;
    protected $table="mejas";
    protected $primarykey="id_meja";
    protected $fillable=['nomor_meja', 'status'];

}
