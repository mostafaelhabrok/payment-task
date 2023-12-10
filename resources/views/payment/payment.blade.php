@extends('template')

@php
$title = 'Payment Form'
@endphp

@section('css')

<link rel="stylesheet" href="{{ asset('css/payment.css?v=1.0.0') }}" />

@stop

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payment Information</h5>

                    <div class="centerloader"></div>
                    <form class="div-disable" id="payment-form">

                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <div class="form-control" id="cardNumber"></div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="expiryDate">Expiry Date</label>
                                <div class="form-control" id="expiryDate"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cvv">CVV</label>
                                <div class="form-control" id="cvv"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cardHolder">Cardholder Name</label>
                            <input type="text" class="form-control" id="cardHolder" placeholder="Enter cardholder name" required>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount ($)</label>
                            <input type="number" step="any" class="form-control" id="amount" placeholder="Enter Amount in USD" required>
                        </div>

                        <button id="submit_payment" type="submit" class="btn btn-primary">Submit Payment</button>
                        
                        <div id="card-errors" role="alert"></div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')

<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">
    var publishable_key = "{{ $publishable_key }}";
</script>

<script type="text/javascript" src="{{ asset('js/payment.js?v=1.0.0') }}"></script>

@stop

