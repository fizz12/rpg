<p>A password reset request was requested for {{ $username }} at FizzRPG. If you didn't request this reset please ignore this email.</p><br />
<p>Please follow <?php echo HTML::link('login/doreset/' . $token, 'this link'); ?> to reset your password.</p><br />
<p>If you are unable to click that link please manually visit <?php echo URL::to('login/doreset/' . $token); ?> in your browser.</p>

<p>Sent by FizzRPG, please don't reply to this email.</p>