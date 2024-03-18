<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AddressCreateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Models\Address;
use App\Models\DeliveryArea;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): View
    {
        $deliveryAreas = DeliveryArea::where('status', 1)->get();
        $userAddresses = Address::where('user_id', auth()->user()->id)->get();
        $orders = Order::where('user_id', auth()->user()->id)->get();

        return view('frontend.dashboard.index', compact('deliveryAreas', 'userAddresses', 'orders'));
    }

    public function createAddress(AddressCreateRequest $request)
    {
        $address = new Address();
        $address->user_id = auth()->user()->id;
        $address->delivery_area_id = $request->area;
        $address->first_name  = $request->first_name;
        $address->last_name  = $request->last_name;
        $address->email  = $request->email;
        $address->phone  = $request->phone;
        $address->address  = $request->address;
        $address->type  = $request->type;
        $address->save();

        toastr()->success('Created Successfully!');

        return redirect()->back();
    }

    public function updateAddress(string $id, AddressCreateRequest $request)
    {
        $address = Address::findOrFail($id);
        $address->user_id = auth()->user()->id;
        $address->delivery_area_id = $request->area;
        $address->first_name  = $request->first_name;
        $address->last_name  = $request->last_name;
        $address->email  = $request->email;
        $address->phone  = $request->phone;
        $address->address  = $request->address;
        $address->type  = $request->type;
        $address->save();

        toastr()->success('Updated Successfully!');

        return to_route('dashboard');
    }

    public function destroyAddress(string $id)
    {

        $address = Address::findOrFail($id);

        if ($address && $address->user_id === auth()->user()->id) {
            $address->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        }

        return response(['status' => 'error', 'message' => 'Something went wrong!']);
    }
}
