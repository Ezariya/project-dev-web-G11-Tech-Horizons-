<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Issue
 * 
 * @property int $id
 * @property string $title
 * @property bool|null $is_public
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Article[] $articles
 *
 * @package App\Models
 */
class Issue extends Model
{
	protected $table = 'issues';

	protected $casts = [
		'is_public' => 'bool'
	];

	protected $fillable = [
		'title',
		'is_public',
		'status'
	];

	public function articles()
	{
		return $this->belongsToMany(Article::class)
					->withPivot('id')
					->withTimestamps();
	}
}
