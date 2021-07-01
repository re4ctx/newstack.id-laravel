<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berita extends Model
{
    // use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'judul', 'kategori', 'konten', 'foto'
    // ];

    protected $fillable = [
        "judul", "kategori", "konten", "foto", "created_at"
    ];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('d, M Y H:i');
    }

    // public function getCreatedAtAttribute($value){
    //     return Carbon::parse($value)->timestamp;
    // }

    // public function getUpdatedAtAttribute($value){
    //     return Carbon::parse($value)->timestamp;
    // }

    // public function toArray()
    // {
    //     $toArray = parent::toArray();
    //     $toArray['foto']= $this->foto;
    //     return $toArray;
    // }

    // public function getPicturePathAttribute() {
    //     return url('') . Storage::url($this->attributes['foto']);
    // }

}
