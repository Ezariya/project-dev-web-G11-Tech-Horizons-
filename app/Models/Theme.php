<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Theme
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $responsable_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User|null $user
 * @property Collection|Article[] $articles
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Theme extends Model
{
	protected $table = 'themes';

	protected $casts = [
		'responsable_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'responsable_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'responsable_id');
	}

	public function articles()
	{
		return $this->hasMany(Article::class);
	}

	public function users()
	{
		return $this->belongsToMany(User::class)
					->withPivot('id')
					->withTimestamps();
	}


}
