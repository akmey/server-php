@component('mail::message')
# {{ __('notification.added.title', ['name' => $key->user->name]) }}

{{ __('notification.added.text1') }}

@component('mail::button', ['url' => $url])
{{ __('notification.added.btn') }}
@endcomponent

{{ __('notification.added.text2') }}<br>
{{ config('app.name') }}
@endcomponent
