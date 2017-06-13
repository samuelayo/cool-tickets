@component('mail::message')
# {{ $content['title'] }}

## {{ $content['email'] }}
### Phone: {{ $content['phone'] }}

{{ $content['body'] }}



Thanks,<br>
{{ config('app.name') }}
@endcomponent
@component('mail::message')



