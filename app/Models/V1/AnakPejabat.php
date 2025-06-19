<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnakPejabat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pejabatTapin()
    {
        return $this->belongsTo(PejabatTapin::class);
    }
}
