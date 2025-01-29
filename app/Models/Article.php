<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $casts = [
        'theme_id' => 'int',
        'author_id' => 'int'
    ];

    protected $fillable = [
        'title',
        'content',
        'theme_id',
        'author_id',
        'status',
        'image_path' // Added
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function issues()
    {
        return $this->belongsToMany(Issue::class)
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }
}
