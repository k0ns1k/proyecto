<x-mail::message>
# Hi {{ $user->name }}

We recently receive a request to recover your account.

@php
$url = url("/auth/change-password/{$user->recovery_token}");
@endphp

<x-mail::button :url="$url">
Recover
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
