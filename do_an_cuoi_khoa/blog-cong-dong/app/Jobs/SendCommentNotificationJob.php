<?php

namespace App\Jobs;

use App\Mail\NewCommentMail;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCommentNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Comment $comment) {}

    public function handle(): void
    {
        $author = $this->comment->post->user;
        if ($author && $author->id !== $this->comment->user_id) {
            Mail::to($author->email)->send(new NewCommentMail($this->comment));
        }
    }
}