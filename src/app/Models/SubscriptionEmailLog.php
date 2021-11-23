<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $subscription_id
 * @property integer $post_id
 * @property string $created_at
 * @property string $modified_at
 * @property string $mail_sent_on
 * @property string $error_details
 * @property string $mail_status
 * @property Subscription $subscription
 * @property Post $post
 */
class SubscriptionEmailLog extends Model
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
    protected $fillable = ['subscription_id', 'post_id', 'created_at', 'modified_at', 'mail_sent_on', 'error_details', 'mail_status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
