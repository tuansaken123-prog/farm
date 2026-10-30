public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Xác thực tài khoản')
            ->view('mail.verify', [
                'userName' => $this->userName,
                'verificationUrl' => url('/')
            ]);
    }