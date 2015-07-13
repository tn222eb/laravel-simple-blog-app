<?php
/**
 * Created by PhpStorm.
 * User: Tommy-dator
 * Date: 2015-06-24
 * Time: 19:23
 */

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body', 'published_at', 'user_id'];

    /**
     * Additional fields to treat as Carbon instances.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * Scope queries to articles that has been published.
     *
     * @param $query
     */
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    /**
     * Scope queries to articles that has not been published.
     *
     * @param $query
     */
    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>=', Carbon::now());
    }

    /**
     * Set the published_at attribute.
     *
     * @param $date
     */
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function getPublishedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * An article is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the tags associated with the given article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
     * Get the list of tag ids associated with the current article.
     *
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id')->toArray();
    }

    /**
     * Check if article has a tag.
     *
     * @return bool
     */
    public function hasATag()
    {
        return count($this->getTagListAttribute()) > 0;
    }
}