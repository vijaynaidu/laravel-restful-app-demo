<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $website_id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $modified_at
 * @property boolean $status
 * @property Website $website
 * @property SubscriptionEmailLog[] $subscriptionEmailLogs
 */
class Post extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['website_id', 'title', 'description', 'created_at', 'modified_at', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function website()
    {
        return $this->belongsTo('App\Models\Website');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptionEmailLogs()
    {
        return $this->hasMany('App\Models\SubscriptionEmailLog');
    }
}
