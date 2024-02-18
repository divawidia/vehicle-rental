<x-mail::message>
    <h1>Thank you <b>{{ $booking->first_name }}</b> for booking a motorbike rental with us<br></h1>
    <x-mail::subcopy>
    <h2>Invoice Number : {{ $booking->transaction_code }}</h2><br>
    <p>Your motorbike rental booking has been confirmed.<br>
        Please pay for your motorbike rental when your motorbike arrives at the delivery location you have specified.<br>
    Customer service will contact you if there's some problem with your reservation<br><br>
    For any questions, contact us on WhatsApp +62 822-3659-2085 or by click this button below</p>
    <x-mail::button :url="'https://wa.me/6282236592085'" color="success">
        Contact Us
    </x-mail::button>
    </x-mail::subcopy>
</x-mail::message>
