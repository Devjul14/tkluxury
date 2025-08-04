@component('mail::message')
# Contract is Ready

Dear {{ $contract->booking->student->name }},

Student housing contract has been prepared.
Please review and sign it at your earliest convenience.

@component('mail::button', ['url' => url('/contracts/' . $contract->id)])
View Contract
@endcomponent

If you have any questions, feel free to contact our support team.

Thanks,<br>
{{ config('app.name') }}
@endcomponent