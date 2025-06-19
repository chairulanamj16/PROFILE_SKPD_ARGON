<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }

    public function videoGalleries()
    {
        return $this->hasMany(VideoGallery::class);
    }

    public function visimisi()
    {
        return $this->hasOne(VisiMisi::class);
    }

    public function tupoksi()
    {
        return $this->hasOne(Tupoksi::class);
    }

    public function sejarahpembentukan()
    {
        return $this->hasOne(SejarahPembentukan::class);
    }

    public function organization()
    {
        return $this->hasOne(Orgranization::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function theme()
    {
        return $this->hasOne(Theme::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function formulations()
    {
        return $this->hasMany(Formulation::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function ppids()
    {
        return $this->hasMany(Ppid::class);
    }

    public function themeGallery()
    {
        return $this->belongsTo(ThemeGallery::class);
    }

    public function popup()
    {
        return $this->hasOne(Popup::class);
    }

    public function officeServices()
    {
        return $this->hasMany(OfficeService::class);
    }

    // v3
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('subdomain', 'like', '%' . $search . '%');
        });
    }
}
