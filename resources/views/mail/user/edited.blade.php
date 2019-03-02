@component('mail::message')
# Hey {{ $user->name }}

Someone (probably you) edited your account details. If it wasn't you, someone probably hacked into your account, please reset your password.

@component('mail::button', ['url' => $url])
Go to my profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
