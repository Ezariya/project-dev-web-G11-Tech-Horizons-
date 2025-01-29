<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $role_id
 *
 * @property Role|null $role
 * @property Collection|Article[] $articles
 * @property Collection|Chat[] $chats
 * @property Collection|History[] $histories
 * @property Collection|Rating[] $ratings
 * @property Collection|Theme[] $themes
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role_id' => 'int',
    ];

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the articles authored by the user.
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    /**
     * Get the chats associated with the user.
     */
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    /**
     * Get the histories associated with the user.
     */
    public function histories()
    {
        return $this->hasMany(History::class);
    }

    /**
     * Get the ratings given by the user.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get the themes managed by the user.
     */
    public function themes()
    {
        return $this->hasMany(Theme::class, 'responsable_id');
    }
    public function theme()
{
    return $this->belongsToMany(Theme::class, 'theme_user');
}




}
