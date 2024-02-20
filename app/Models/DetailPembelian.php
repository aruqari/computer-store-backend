<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = "detail_pembelian";
    protected $primaryKey = "id_detail_pembelian";
    public $timestamps = true;
    protected $fillable = ["id_pembelian", "id_katalog", "qty", "subtotal"];
}
