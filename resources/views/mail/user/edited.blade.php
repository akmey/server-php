@component('mail::message')
# {{ __('notification.user.title', ['user' => $user->name]) }}

{{ __('notification.user.text1') }}

@component('mail::button', ['url' => $url])
{{ __('notification.user.btn') }}
@endcomponent

{{ __('notification.user.text2') }}<br>
{{ config('app.name') }}
@endcomponent
