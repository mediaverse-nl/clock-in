@component('mail::message')
# Account Registratie

Beste {{$user->name}},

Dit zijn de inloggegevens van uw account, u kunt inloggen via de link hier onder.

@component('mail::button', ['url' => url('/login')])
Inloggen
@endcomponent

@component('mail::panel')
## Inloggegevens

Naam: {{$user->name}}<br>
Gebruikersnaam: {{$email}}<br>
watchwoord: {{$password}}
@endcomponent

Met vriendelijke groet,<br>
{{ config('app.name') }}
@endcomponent