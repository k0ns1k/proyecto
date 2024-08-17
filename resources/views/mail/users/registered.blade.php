<x-mail::message>
# Welcome {{ $user->name }}

Please verify your email address.

@php
$url = url("/auth/verify/{$user->verification_token}");
@endphp

<x-mail::button :url="$url">
Verify
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
