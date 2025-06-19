<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeGallery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function office()
    {
        return $this->hasMany(MyTheme::class);
    }
}
