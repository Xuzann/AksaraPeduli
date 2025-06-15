<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'target_amount', 'collected_amount', 'deadline', 'updates',
    ];

    // Tentukan kolom primary key
    protected $primaryKey = 'campaign_id';  // Menetapkan campaign_id sebagai primary key

    // Jika campaign_id bukan auto-increment, tambahkan ini
    public $incrementing = false;

    // Tentukan tipe data primary key
    protected $keyType = 'string';  // Jika campaign_id menggunakan tipe data selain integer

    // Relasi ke Donasi
    public function donations()
    {
        return $this->hasMany(Donation::class, 'campaign_id', 'campaign_id');
    }
}
