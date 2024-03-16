<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentGatewaySetting;
use App\Services\PaymentGatewaySettingService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentGatewaySettingController extends Controller
{
    use FileUploadTrait;

    public function index(): View
    {
        $paymentGateway = PaymentGatewaySetting::pluck('value', 'key');

        return view('admin.payment-setting.index', compact('paymentGateway'));
    }

    public function paypalSettingUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'paypal_status' => ['required', 'boolean'],
            'paypal_account_mode' => ['required', 'in:sandbox,live'],
            'paypal_country_name' => ['required'],
            'paypal_currency' => ['required'],
            'paypal_rate' => ['required', 'numeric'],
            'paypal_api_key' => ['required'],
            'paypal_secret_id' => ['required'],
            'paypal_app_id' => ['required'],

        ]);

        if ($request->hasFile('paypal_logo')) {
            $request->validate([
                'paypal_logo' => ['nullable', 'image']
            ]);

            $imagePath = $this->uploadImage($request, 'paypal_logo');

            PaymentGatewaySetting::updateOrCreate(
                [
                    'key' => 'paypal_logo'
                ],
                [
                    'value' => $imagePath
                ]
            );
        }

        foreach ($validatedData as $key => $value) {
            PaymentGatewaySetting::updateOrCreate(
                [
                    'key' => $key
                ],
                [
                    'value' => $value
                ]
            );
        }

        $paymentGatewaySettingService = app(PaymentGatewaySettingService::class);
        $paymentGatewaySettingService->clearCachedSettings();

        toastr()->success('Updated Successfully!');

        return redirect()->back();
    }
}
