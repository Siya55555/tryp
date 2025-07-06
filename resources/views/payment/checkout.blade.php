@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Payment Information</h4>
                </div>
                <div class="card-body">
                    <form id="payment-form" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <h5>Select Payment Method</h5>
                            <div class="payment-methods mb-3" id="payment-methods-container">
                                <!-- Payment methods will be loaded dynamically -->
                                <div class="text-center py-3">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Credit Card Information</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="card_number" class="form-label">Card Number</label>
                                    <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid card number.
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="exp_month" class="form-label">Month</label>
                                    <select class="form-select" id="exp_month" name="exp_month" required>
                                        <option value="">MM</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select expiration month.
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="exp_year" class="form-label">Year</label>
                                    <select class="form-select" id="exp_year" name="exp_year" required>
                                        <option value="">YYYY</option>
                                        @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select expiration year.
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="cvc" class="form-label">CVC</label>
                                    <input type="text" class="form-control" id="cvc" name="cvc" placeholder="123" required>
                                    <div class="invalid-feedback">
                                        Please enter the security code.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Cardholder Information</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="name" class="form-label">Name on Card</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                                    <div class="invalid-feedback">
                                        Please enter the name as it appears on the card.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Billing Address</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
                                </div>

                                <div class="col-md-5">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>

                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state">
                                </div>

                                <div class="col-md-3">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="zip" name="zip">
                                </div>

                                <div class="col-12">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" id="country" name="country">
                                        <option value="">Choose...</option>
                                        <option value="US">United States</option>
                                        <option value="CA">Canada</option>
                                        <option value="GB">United Kingdom</option>
                                        <!-- Add more countries as needed -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <input type="hidden" name="amount" id="amount" value="{{ $amount ?? '0.00' }}">
                            <input type="hidden" name="currency" id="currency" value="{{ $currency ?? 'USD' }}">
                            <input type="hidden" name="gateway_type" id="gateway_type" value="">
                            <button class="btn btn-primary btn-lg" type="submit" id="submit-button">
                                Pay ${{ $amount ?? '0.00' }}
                            </button>
                        </div>
                    </form>

                    <div id="payment-result" class="mt-4" style="display: none;">
                        <div class="alert" role="alert"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load available payment methods
        loadPaymentMethods();

        // Format credit card number with spaces
        document.getElementById('card_number').addEventListener('input', function(e) {
            const input = e.target;
            let value = input.value.replace(/\s+/g, '');
            if (value.length > 0) {
                value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
            }
            input.value = value;
        });

        // Handle form submission
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            if (!form.checkValidity()) {
                event.stopPropagation();
                form.classList.add('was-validated');
                return;
            }
            
            processPayment();
        });
    });

    function loadPaymentMethods() {
        fetch('/api/payment-gateways')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.gateways.length > 0) {
                    const container = document.getElementById('payment-methods-container');
                    container.innerHTML = '';
                    
                    data.gateways.forEach(gateway => {
                        const isDefault = gateway.is_default ? 'checked' : '';
                        let gatewayHtml = `
                            <div class="form-check payment-method-option mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                    id="payment-${gateway.id}" value="${gateway.gateway_type}" ${isDefault}>
                                <label class="form-check-label d-flex align-items-center" for="payment-${gateway.id}">
                        `;
                        
                        if (gateway.icon) {
                            gatewayHtml += `<img src="/storage/${gateway.icon}" alt="${gateway.display_name}" class="payment-icon me-2" style="height: 30px;">`;
                        } else {
                            gatewayHtml += `<i class="fas fa-credit-card me-2"></i>`;
                        }
                        
                        gatewayHtml += `
                                    <span>${gateway.display_name}</span>
                                </label>
                            </div>
                        `;
                        
                        if (gateway.instructions) {
                            gatewayHtml += `
                                <div class="payment-instructions ms-4 mb-3 small text-muted">
                                    ${gateway.instructions}
                                </div>
                            `;
                        }
                        
                        container.innerHTML += gatewayHtml;
                    });
                    
                    // Add event listeners to radio buttons
                    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
                        radio.addEventListener('change', function() {
                            document.getElementById('gateway_type').value = this.value;
                        });
                        
                        // Set default gateway
                        if (radio.checked) {
                            document.getElementById('gateway_type').value = radio.value;
                        }
                    });
                } else {
                    document.getElementById('payment-methods-container').innerHTML = 
                        '<div class="alert alert-warning">No payment methods available.</div>';
                }
            })
            .catch(error => {
                console.error('Error loading payment methods:', error);
                document.getElementById('payment-methods-container').innerHTML = 
                    '<div class="alert alert-danger">Failed to load payment methods. Please try again later.</div>';
            });
    }

    function processPayment() {
        const submitButton = document.getElementById('submit-button');
        const resultElement = document.getElementById('payment-result');
        const alertElement = resultElement.querySelector('.alert');
        
        // Disable button and show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
        
        // Collect form data
        const formData = new FormData(document.getElementById('payment-form'));
        const paymentData = {};
        
        for (const [key, value] of formData.entries()) {
            paymentData[key] = value;
        }
        
        // Remove spaces from card number
        paymentData.card_number = paymentData.card_number.replace(/\s+/g, '');
        
        // Send payment request
        fetch('/api/process-payment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(paymentData)
        })
        .then(response => response.json())
        .then(data => {
            resultElement.style.display = 'block';
            
            if (data.success) {
                alertElement.className = 'alert alert-success';
                alertElement.innerHTML = `
                    <h5><i class="fas fa-check-circle"></i> Payment Successful</h5>
                    <p>Transaction ID: ${data.transaction.transaction_id}</p>
                    <p>Amount: $${data.transaction.amount} ${data.transaction.currency}</p>
                    <p>${data.transaction.message}</p>
                `;
                
                // Redirect to success page after a delay
                setTimeout(() => {
                    window.location.href = '/payment/success?tid=' + data.transaction.transaction_id;
                }, 3000);
            } else {
                alertElement.className = 'alert alert-danger';
                alertElement.innerHTML = `
                    <h5><i class="fas fa-times-circle"></i> Payment Failed</h5>
                    <p>${data.message}</p>
                `;
                submitButton.disabled = false;
                submitButton.innerHTML = 'Try Again';
            }
        })
        .catch(error => {
            console.error('Error processing payment:', error);
            resultElement.style.display = 'block';
            alertElement.className = 'alert alert-danger';
            alertElement.innerHTML = `
                <h5><i class="fas fa-exclamation-triangle"></i> Error</h5>
                <p>An unexpected error occurred. Please try again later.</p>
            `;
            submitButton.disabled = false;
            submitButton.innerHTML = 'Try Again';
        });
    }
</script>
@endpush
