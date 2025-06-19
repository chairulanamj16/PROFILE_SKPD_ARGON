<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'posts';

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function postCategories()
    {
        return $this->belongsToMany(PostCategory::class);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', '%' . $term . '%')
                ->orWhere('body', 'like', '%' . $term . '%')
                ->orWhere('excercept', 'like', '%' . $term . '%');
        });
    }
}
