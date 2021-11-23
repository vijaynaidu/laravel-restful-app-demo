<?php

namespace App\Jobs;

use App\Mail\SendSubscribersMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\{Post, Website};

class PostNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $postId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $postDetails = Post::find($this->postId);
        $websiteId = $postDetails->website_id;

        $websiteSubscriptions = Website::find($websiteId)->with('subscriptions')->first();
        $subscribers = $websiteSubscriptions["subscriptions"];

        foreach($subscribers as $subscriber){
            $toSubscriber = new \stdClass();
            $toSubscriber->email = $subscriber->email;
            $toSubscriber->name  = $subscriber->name;
            
            Mail::to($toSubscriber)->send((new SendSubscribersMail($subscriber->name, $postDetails)));
        }
    }
}
