@extends('client.layouts.app')

@section('title')
    Payment | Batur Sari Rental Bali
@endsection

@section('content')
    <!-- content begin -->
    <div class="no-bottom space-top zebra" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="/images/background/16.jpg" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Thankyou, {{ $booking->first_name }}!</h1>
                        </div>
                        <div class="col-md-12 text-center">
                            <h5 class="mt-3 mb-4">Please pay your rental booking with total amount of
                                Rp. {{ number_format($booking->total_price) }}</h5>
                            <button
                                type="button"
                                id="pay-button"
                                class="btn-main"
                            >Click here to pay
                            </button>
                        </div>
                        <div class="clearfix"></div>
                        <pre>
                            <div id="result-json"></div>
                        </pre>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->
    </div>
    <!-- content close -->
@endsection

@push('addon-script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            // SnapToken acquired from previous step
            snap.pay('{{ $booking->snap_token }}', {
                // Optional
                onSuccess: function (result) {
                    /* You may add your own js here, this is just example */
                    fetch('{{ url()->route('update-payment-booking-status', ['id' => $booking->id, 'transaction_code' => $booking->transaction_code]) }}', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(window.location.href = '{{ route('pay-success', $booking->transaction_code) }}')
                },
                // Optional
                onPending: function (result) {
                    /* You may add your own js here, this is just example */
                    window.location.href = '{{ route('pay-booking', $booking->transaction_code) }}'
                },
                // Optional
                onError: function (result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endpush
