@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h2 class="card-title mb-4">Payment Successful!</h2>
                    <p class="card-text mb-4">Your payment has been successfully processed. Thank you for your purchase!</p>
                    
                    @if(isset($transactionId))
                        <div class="alert alert-info mb-4">
                            <strong>Transaction ID:</strong> {{ $transactionId }}
                        </div>
                        <p class="small text-muted">Please save this transaction ID for your records.</p>
                    @endif
                    
                    <div class="mt-5">
                        <a href="{{ route('home') }}" class="btn btn-primary">Return to Homepage</a>
                        <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-primary ms-2">View My Bookings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
