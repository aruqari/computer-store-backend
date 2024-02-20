<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = "pembelian";
    protected $primaryKey = "id_pembelian";
    protected $keyType = "string";
    public $timestamps = true;
    protected $fillable = ["id_pembelian", "id_user", "status", "total_harga"];
}
