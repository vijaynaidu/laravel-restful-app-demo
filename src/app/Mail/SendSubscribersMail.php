<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSubscribersMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $postDetails;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, Post $postDetails)
    {
        $this->postDetails = $postDetails;
        $this->name = $name;

        $this->subject(sprintf('New post "%s"', strip_tags($postDetails->title)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $postDetails = $this->postDetails;

        return $this->view('subscibers_mail', ["postDescription" => $postDetails->description]);
    }
}
