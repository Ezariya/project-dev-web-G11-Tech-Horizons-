<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticleIssue
 * 
 * @property int $id
 * @property int $article_id
 * @property int $issue_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Article $article
 * @property Issue $issue
 *
 * @package App\Models
 */
class ArticleIssue extends Model
{
	protected $table = 'article_issue';

	protected $casts = [
		'article_id' => 'int',
		'issue_id' => 'int'
	];

	protected $fillable = [
		'article_id',
		'issue_id'
	];

	public function article()
	{
		return $this->belongsTo(Article::class);
	}

	public function issue()
	{
		return $this->belongsTo(Issue::class);
	}
}
