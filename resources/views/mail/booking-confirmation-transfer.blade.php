<x-mail::message>
    <h1>Thank you <b>{{ $booking->first_name }}</b> for booking a motorbike rental with us<br></h1>
    <x-mail::subcopy>
    <h2>Invoice Number : {{ $booking->transaction_code }}</h2>
    <p>Please pay your reservation by click this button below.</P>
    <x-mail::button :url="'/payment/'.$booking->transaction_code" color="success">
        Pay Now
    </x-mail::button>
    <P>For any questions, contact us on WhatsApp +62 822-3659-2085 or by click this button below</p>
    <x-mail::button :url="'https://wa.me/6282236592085'" color="success">
        Contact Us
    </x-mail::button>
    </x-mail::subcopy>
</x-mail::message>
