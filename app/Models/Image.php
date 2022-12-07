<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'urls',
        'galleries_id',
        'user_id',
    ];

    public function galleries()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
