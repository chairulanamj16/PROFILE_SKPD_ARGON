<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpidCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ppids()
    {
        return $this->hasMany(Ppid::class);
    }
}
