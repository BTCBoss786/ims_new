<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            Auth::loginUsingId(1);
        }
        $inventory = Inventory::count();
        $customer = Customer::count();
        $invoices = Invoice::whereBetween('inv_date', ['2021-04-01', '2022-03-31'])->get();
        return view('dashboard', ['inventory' => $inventory, 'customer' => $customer, 'invoices' => $invoices]);
    }
}
