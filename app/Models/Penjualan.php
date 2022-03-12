<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = "penjualan";
    protected $fillable = ['status'];

    public function place(){
        return $this->belongsTo(Place::class, 'place_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function penjualan_detail(){
        return $this->hasMany(PenjualanDetail::class, 'penjualan_id','id');
    }
}
