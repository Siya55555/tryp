@extends('layouts.app')

@section('title', 'Payment Cancelled')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 5rem;"></i>
                    </div>
                    <h2 class="card-title mb-4">Payment Cancelled</h2>
                    <p class="card-text mb-4">Your payment has been cancelled. No charges were made to your account.</p>
                    
                    <div class="alert alert-info mb-4">
                        If you experienced any issues during the payment process, please contact our support team.
                    </div>
                    
                    <div class="mt-5">
                        <a href="{{ route('payment.checkout') }}" class="btn btn-primary">Try Again</a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary ms-2">Return to Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
