<h2>Yêu cầu đặt lại mật khẩu</h2>
<p>Bạn nhận được email này vì hệ thống nhận được yêu cầu cấp lại mật khẩu cho tài khoản của bạn.</p>
<p>Vui lòng bấm vào nút bên dưới để đặt lại mật khẩu mới:</p>
<a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" 
   style="background: #0d6efd; color: #fff; padding: 10px 15px; text-decoration: none; border-radius: 5px;">
   Đặt lại mật khẩu
</a>