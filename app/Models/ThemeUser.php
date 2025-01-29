<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ThemeUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $theme_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Theme $theme
 * @property User $user
 *
 * @package App\Models
 */
class ThemeUser extends Model
{
	protected $table = 'theme_user';

	protected $casts = [
		'user_id' => 'int',
		'theme_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'theme_id',
        'is_blocked'
	];

	public function theme()
	{
		return $this->belongsTo(Theme::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
