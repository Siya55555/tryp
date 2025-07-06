<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gateways = PaymentGateway::all();
        return view('admin.payment-gateways.index', compact('gateways'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gatewayTypes = [
            'stripe' => 'Stripe',
            'paypal' => 'PayPal',
            'authorize_net' => 'Authorize.net',
        ];
        
        return view('admin.payment-gateways.create', compact('gatewayTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debug info
        //dd($request->all());
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:payment_gateways',
            'display_name' => 'required|string|max:255',
            'gateway_type' => 'required|string',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
        ]);

        // Handle config based on gateway type
        $config = $this->processGatewayConfig($request);
        
        // Handle icon upload if present
        $iconPath = null;
        if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            $iconPath = $request->file('icon')->store('payment-gateways', 'public');
        }

        try {
            // Create the gateway with explicit boolean conversions
            $gateway = new PaymentGateway();
            $gateway->name = $validated['name'];
            $gateway->display_name = $validated['display_name'];
            $gateway->gateway_type = $validated['gateway_type'];
            $gateway->is_active = $request->has('is_active') ? true : false;
            $gateway->is_default = $request->has('is_default') ? true : false;
            $gateway->description = $validated['description'] ?? null;
            $gateway->instructions = $validated['instructions'] ?? null;
            $gateway->config = $config;
            $gateway->icon = $iconPath;
            $gateway->save();
            
            // If this is set as default, update other gateways
            if ($request->has('is_default')) {
                PaymentGateway::where('id', '!=', $gateway->id)->update(['is_default' => false]);
            }
            
            return redirect()->route('admin.payment-gateways.index')
                ->with('success', 'Payment gateway created successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating payment gateway: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gateway = PaymentGateway::findOrFail($id);
        return view('admin.payment-gateways.show', compact('gateway'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gateway = PaymentGateway::findOrFail($id);
        $gatewayTypes = [
            'stripe' => 'Stripe',
            'paypal' => 'PayPal',
            'authorize_net' => 'Authorize.net',
        ];
        
        return view('admin.payment-gateways.edit', compact('gateway', 'gatewayTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gateway = PaymentGateway::findOrFail($id);
        
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('payment_gateways')->ignore($gateway->id),
            ],
            'display_name' => 'required|string|max:255',
            'gateway_type' => 'required|string',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
        ]);

        // Handle config based on gateway type
        $config = $this->processGatewayConfig($request, $gateway->config);
        
        // Handle icon upload if present
        $iconPath = $gateway->icon;
        if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            $iconPath = $request->file('icon')->store('payment-gateways', 'public');
        }

        // Update the gateway
        $gateway->update([
            'name' => $validated['name'],
            'display_name' => $validated['display_name'],
            'gateway_type' => $validated['gateway_type'],
            'is_active' => $request->has('is_active'),
            'is_default' => $request->has('is_default'),
            'description' => $validated['description'] ?? null,
            'instructions' => $validated['instructions'] ?? null,
            'config' => $config,
            'icon' => $iconPath,
        ]);

        // If this is set as default, update other gateways
        if ($request->has('is_default')) {
            PaymentGateway::where('id', '!=', $gateway->id)->update(['is_default' => false]);
        }

        return redirect()->route('admin.payment-gateways.index')
            ->with('success', 'Payment gateway updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gateway = PaymentGateway::findOrFail($id);
        $gateway->delete();

        return redirect()->route('admin.payment-gateways.index')
            ->with('success', 'Payment gateway deleted successfully');
    }

    /**
     * Process gateway configuration based on the gateway type
     *
     * @param Request $request
     * @param array|null $existingConfig
     * @return array
     */
    protected function processGatewayConfig(Request $request, $existingConfig = null)
    {
        $existingConfig = is_array($existingConfig) ? $existingConfig : [];
        $config = $existingConfig;
        
        // Process based on gateway type
        switch ($request->gateway_type) {
            case 'stripe':
                if ($request->filled('stripe_api_key')) {
                    $config['api_key'] = $request->stripe_api_key;
                }
                if ($request->filled('stripe_secret_key')) {
                    $config['secret_key'] = $request->stripe_secret_key;
                }
                if ($request->filled('stripe_webhook_secret')) {
                    $config['webhook_secret'] = $request->stripe_webhook_secret;
                }
                break;
                
            case 'paypal':
                if ($request->filled('paypal_client_id')) {
                    $config['client_id'] = $request->paypal_client_id;
                }
                if ($request->filled('paypal_secret')) {
                    $config['secret'] = $request->paypal_secret;
                }
                if ($request->filled('paypal_environment')) {
                    $config['environment'] = $request->paypal_environment;
                }
                break;
                
            case 'authorize_net':
                if ($request->filled('authorize_login_id')) {
                    $config['login_id'] = $request->authorize_login_id;
                }
                if ($request->filled('authorize_transaction_key')) {
                    $config['transaction_key'] = $request->authorize_transaction_key;
                }
                $config['sandbox_mode'] = $request->has('authorize_sandbox_mode');
                break;
        }
        
        // Process any custom configurations
        if ($request->has('custom_config') && is_array($request->custom_config)) {
            foreach ($request->custom_config as $key => $value) {
                $config[$key] = $value;
            }
        }
        
        // Add debug log
        \Illuminate\Support\Facades\Log::debug('Payment gateway config', ['config' => $config]);
        
        return $config;
    }
}
