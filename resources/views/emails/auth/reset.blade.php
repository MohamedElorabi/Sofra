@component('mail::message')
# Introduction

Blood Bank Reset Password

@component('mail::button', ['url' => 'http://ipda3.com', 'color' => 'success'])
Reset
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
