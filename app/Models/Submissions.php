<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Submissions extends Model {

	/** Model Settings **/
	protected $table      = 'submissions';
	protected $primaryKey = 'id';
	protected $guarded    = ['id'];
	protected $hidden     = [];
	public $timestamps    = false;
	/** Appendable Attributes **/
	public $appends = ['permalink'];

	/**
	 * Get Permalink by Traversal
	 * @return string
	 */
	public function getPermalinkAttribute() {
		$parent   = $this;
		$segments = new Collection();
		do {
			$segments->push($parent->post_name);
		} while ($parent = $parent->parent);
		return url($segments->reverse()->implode('/'));
	}

	/**
	 * Post Parent Relationship
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function documents() {
		return $this->hasMany(Documents::class, 'submission_id', 'id');
	}

	public function user() {
		return $this->hasOne(WpUser::class, 'ID', 'user_id');
	}

}