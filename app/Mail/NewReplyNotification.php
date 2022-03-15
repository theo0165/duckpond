<?php

namespace App\Mail;

use App\Models\Community;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewReplyNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private Community $community, private Post $post, private string $type)
    {
        // $this->community = $community;
        // $this->post = $post;
        // $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->subject('Duckpond: New reply')
                ->view('mail.new-reply-notification', [
                    'community' => $this->community,
                    'post' => $this->post,
                    'type' => $this->type
                ]);
    }
}
