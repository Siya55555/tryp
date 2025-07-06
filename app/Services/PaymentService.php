<?php

namespace App\Services;

use App\Models\PaymentGateway;
use Exception;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentMethod;
use Stripe\PaymentIntent;

class PaymentService
{
    /**
     * Get the active payment gateway
     *
     * @return PaymentGateway|null
     */
    public function getActiveGateway()
    {
        return PaymentGateway::where('is_active', true)
            ->where('is_default', true)
            ->first() ?? PaymentGateway::where('is_active', true)->first();
    }

    /**
     * Process a credit card payment
     *
     * @param string $stripeToken Stripe token from Elements
     * @param float $amount Amount to charge
     * @param string $currency Currency code
     * @param array $customerInfo Customer information
     * @param string $description Payment description
     * @param string|null $gatewayType Override the default gateway
     * @return array
     * @throws Exception
     */
    public function processCardPayment($stripeToken, float $amount, string $currency, array $customerInfo, string $description, ?string $gatewayType = null)
    {
        // Get the payment gateway to use
        $gateway = $gatewayType 
            ? PaymentGateway::where('gateway_type', $gatewayType)->where('is_active', true)->first()
            : $this->getActiveGateway();

        if (!$gateway) {
            throw new Exception('No active payment gateway is available');
        }

        $gatewayConfig = $gateway->getConfigArray();

        // Process based on gateway type
        try {
            switch ($gateway->gateway_type) {
                case 'stripe':
                    return $this->processStripePayment($stripeToken, $amount, $currency, $customerInfo, $description, $gatewayConfig);
                case 'paypal':
                    return $this->processPayPalPayment($stripeToken, $amount, $currency, $customerInfo, $description, $gatewayConfig);
                case 'authorize_net':
                    return $this->processAuthorizeNetPayment($stripeToken, $amount, $currency, $customerInfo, $description, $gatewayConfig);
                default:
                    throw new Exception("Payment gateway '{$gateway->gateway_type}' is not supported");
            }
        } catch (Exception $e) {
            Log::error('Payment processing failed: ' . $e->getMessage(), [
                'gateway' => $gateway->name,
                'amount' => $amount,
                'currency' => $currency,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Process payment through Stripe using a token from Elements
     */
    protected function processStripePayment($stripeToken, float $amount, string $currency, array $customerInfo, string $description, array $config)
    {
        \Stripe\Stripe::setApiKey($config['secret_key']);
        try {
            $charge = \Stripe\Charge::create([
                'amount' => (int)round($amount * 100),
                'currency' => $currency,
                'source' => $stripeToken,
                'description' => $description,
                'receipt_email' => $customerInfo['email'],
                'metadata' => [
                    'customer_name' => $customerInfo['name'],
                    'customer_address' => $customerInfo['address'] ?? '',
                    'customer_city' => $customerInfo['city'] ?? '',
                    'customer_state' => $customerInfo['state'] ?? '',
                    'customer_zip' => $customerInfo['zip'] ?? '',
                ],
            ]);
            if ($charge->status === 'succeeded') {
                return [
                    'success' => true,
                    'transaction_id' => $charge->id,
                    'gateway' => 'stripe',
                    'amount' => $amount,
                    'currency' => $currency,
                    'message' => 'Payment processed successfully',
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Payment failed: ' . $charge->status,
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Process payment through PayPal
     *
     * @param string $stripeToken Stripe token from Elements
     * @param float $amount
     * @param string $currency
     * @param array $customerInfo
     * @param string $description
     * @param array $config
     * @return array
     */
    protected function processPayPalPayment($stripeToken, float $amount, string $currency, array $customerInfo, string $description, array $config)
    {
        // This is a placeholder. In a real implementation, you would use the PayPal SDK.
        // You would need to install the PayPal PHP SDK: composer require paypal/rest-api-sdk-php

        // Simulated response for demo purposes
        return [
            'success' => true,
            'transaction_id' => 'pp_' . uniqid(),
            'gateway' => 'paypal',
            'amount' => $amount,
            'currency' => $currency,
            'message' => 'Payment processed successfully',
        ];
    }

    /**
     * Process payment through Authorize.net
     *
     * @param string $stripeToken Stripe token from Elements
     * @param float $amount
     * @param string $currency
     * @param array $customerInfo
     * @param string $description
     * @param array $config
     * @return array
     */
    protected function processAuthorizeNetPayment($stripeToken, float $amount, string $currency, array $customerInfo, string $description, array $config)
    {
        // This is a placeholder. In a real implementation, you would use the Authorize.Net SDK.
        // You would need to install the Authorize.Net PHP SDK: composer require authorizenet/authorizenet

        // Simulated response for demo purposes
        return [
            'success' => true,
            'transaction_id' => 'auth_' . uniqid(),
            'gateway' => 'authorize_net',
            'amount' => $amount,
            'currency' => $currency,
            'message' => 'Payment processed successfully',
        ];
    }

    /**
     * Validate credit card information
     *
     * @param array $cardData Credit card data including number, exp month/year, cvv
     * @return bool
     */
    public function validateCardData(array $cardData): bool
    {
        // Check required fields
        $requiredFields = ['card_number', 'exp_month', 'exp_year', 'cvc'];
        foreach ($requiredFields as $field) {
            if (!isset($cardData[$field]) || empty($cardData[$field])) {
                return false;
            }
        }

        // Validate card number (simple Luhn algorithm check)
        if (!$this->validateCardNumber($cardData['card_number'])) {
            return false;
        }

        // Validate expiration date
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('m');
        $expYear = (int) $cardData['exp_year'];
        $expMonth = (int) $cardData['exp_month'];

        if ($expYear < $currentYear || ($expYear === $currentYear && $expMonth < $currentMonth)) {
            return false;
        }

        return true;
    }

    /**
     * Validate a credit card number using the Luhn algorithm
     *
     * @param string $cardNumber
     * @return bool
     */
    protected function validateCardNumber(string $cardNumber): bool
    {
        // Remove spaces and dashes
        $cardNumber = preg_replace('/\D/', '', $cardNumber);
        
        // Check if the number contains only digits
        if (!ctype_digit($cardNumber)) {
            return false;
        }
        
        // Implement the Luhn algorithm check
        $sum = 0;
        $length = strlen($cardNumber);
        
        for ($i = 0; $i < $length; $i++) {
            $digit = (int) $cardNumber[$length - $i - 1];
            if ($i % 2 == 1) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
        }
        
        return ($sum % 10) == 0;
    }
}