<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * 
 * @property int $id
 * @property int $user_id
 * @property int $article_id
 * @property Carbon|null $created_at
 * 
 * @property Article $article
 * @property User $user
 *
 * @package App\Models
 */
class History extends Model
{
	protected $table = 'history';
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'article_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'article_id'
	];

	public function article()
	{
		return $this->belongsTo(Article::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
