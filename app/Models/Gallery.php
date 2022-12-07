<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function scopeSearchByName($query, $term)
    {
        return $query->when($term, function ($query, $term) {
            $query->orWhere('name', 'LIKE', '%' . $term . '%');
        });
    }

    public function scopeSearchByDescription($query, $term)
    {
        return $query->when($term, function ($query, $term) {
            $query->orWhere('description', 'LIKE', '%' . $term . '%');
        });
    }
}
