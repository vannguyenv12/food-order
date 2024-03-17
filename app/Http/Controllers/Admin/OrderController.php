<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function show($id): View
    {
        $order = Order::findOrFail($id);

        return view('admin.order.show', compact('order'));
    }

    public function orderStatusUpdate(Request $request, string $id): RedirectResponse | Response
    {
        $request->validate([
            'payment_status' => ['required', 'in:pending,completed'],
            'order_status' => ['required', 'in:pending,in_process,delivered,declined']
        ]);


        $order = Order::findOrFail($id);
        $order->payment_status = $request->payment_status;
        $order->order_status = $request->order_status;

        $order->save();

        if ($request->ajax()) {
            return response(['message' => 'Order Status Updated!']);
        } else {
            toastr()->success('Status Updated Successfully!');

            return redirect()->back();
        }
    }

    public function getOrderStatus(string $id): Response
    {
        $order = Order::select(['order_status', 'payment_status'])->findOrFail($id);

        return response($order);
    }
}
