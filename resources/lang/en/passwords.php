<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'password' => 'Passwords must be at least eight characters and match the confirmation.',
    'reset' => 'Your password has been reset!',
    'sent' => 'We have e-mailed your password reset link!',
    'token' => 'This password reset token is invalid.',
    'user' => "We can't find a user with that e-mail address.",

    'mail' => [
        'subject' => 'Reset Password Notification',
        'title' => 'Hello!',
        'text1' => 'You are receiving this email because we received a password reset request for your account.',
        'btn' => 'Reset Password',
        'text2' => 'This password reset link will expire in 60 minutes.
        If you did not request a password reset, no further action is required.
        Regards,',
        'trouble' => 'If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:'
    ]

];
