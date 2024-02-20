<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    protected $table = "katalog";
    protected $primaryKey = "id_katalog";
    protected $keyType = "string";
    public $timestamps = true;
    protected $fillable = ["id_katalog", "nama", "image", "desc", "harga", "stok"];
}
