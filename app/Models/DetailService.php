<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailService extends Model
{
    protected $table = "detail_service";
    protected $primaryKey = "id_detail_service";
    protected $keyType = "string";
    public $timestamps = true;
    protected $fillable = ["id_detail_service", "id_user", "nama_perangkat", "keluhan", "catatan_teknisi", "harga"];
}
