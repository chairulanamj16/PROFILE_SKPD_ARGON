<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppid extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function ppid_category()
    {
        return $this->belongsTo(PpidCategory::class);
    }
}
