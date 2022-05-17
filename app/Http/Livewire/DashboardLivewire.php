<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardLivewire extends Component
{

    public $inventories;
    public $customers;
    public $invoices;
    public $monthlyRevenue;

    public function mount()
    {
        $this->inventories    = \App\Models\Inventory::count();
        $this->customers      = \App\Models\Customer::count();
        $this->invoices       = \App\Models\Invoice::whereBetween('inv_date',
            ['2022-04-01', '2023-03-31'])->get();
        $this->monthlyRevenue = $this->getMonthlyRevenue($this->invoices);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    private function getMonthlyRevenue($revenueData = null)
    {
        if (isset($revenueData)) {
            return $revenueData->groupBy(function ($invoice) {
                return $invoice->inv_date->format('M');
            })->map(function ($row) {
                return $row->sum('grand_total');
            })->toArray();
        }

        return [];
    }

}
