<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyTheme extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ThemeGalleries()
    {
        return $this->belongsToMany(ThemeGallery::class);
    }

    public function ThemeGallery()
    {
        return $this->belongsTo(ThemeGallery::class);
    }
}
