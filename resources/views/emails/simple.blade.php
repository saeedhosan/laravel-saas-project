@component('mail::message')

<b>Subject</b>: {!! $subject !!} <br><br>

{!! $message !!}


{{ __('locale.labels.thanks') }},<br>
{{ config('app.name') }}
@endcomponent
