@component('mail::message')
# {{ __('notification.removed.title', ['name' => $key->user->name]) }}

{{ __('notification.removed.text1') }}

@component('mail::button', ['url' => $url])
{{ __('notification.removed.btn') }}
@endcomponent

{{ __('notification.removed.text2') }}<br>
{{ config('app.name') }}
@endcomponent
