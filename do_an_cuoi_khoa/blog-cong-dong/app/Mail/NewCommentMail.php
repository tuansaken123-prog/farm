<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Comment $comment) {}

    public function build()
    {
        return $this->subject('Bài viết của bạn có bình luận mới')
                    ->html("<p>Người dùng <strong>{$this->comment->user->name}</strong> đã bình luận vào bài viết <strong>{$this->comment->post->title}</strong>:</p><blockquote>{$this->comment->content}</blockquote>");
    }
}