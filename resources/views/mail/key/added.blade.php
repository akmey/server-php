@component('mail::message')
# Hey {{ $key->user->name }}

Someone (probably you) added a key to your account. If it wasn't you, someone probably hacked into your account, please reset your password and delete the key.

@component('mail::button', ['url' => $url])
Go to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
