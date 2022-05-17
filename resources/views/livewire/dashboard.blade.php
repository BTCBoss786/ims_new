<div>

    <div class="row g-5 p-5">
        <x-card-component header="Inventories" :title="$inventories" />
        <x-card-component header="Customers" :title="$customers" />
        <x-card-component header="Invoices" :title="$invoices->count()" />
    </div>

    <div class="row g-5 p-5 pt-0">
        <x-card-component header="Total Revenue" :title="$invoices->sum('grand_total')" />
        <x-card-component header="Last Month" :title="$invoices->whereBetween('inv_date', [Carbon\Carbon::now()->startOfMonth()->subMonthsNoOverflow(), Carbon\Carbon::now()->subMonthsNoOverflow()->endOfMonth()])->sum('grand_total')" />
        <x-card-component header="Current Month" :title="$invoices->whereBetween('inv_date', [Carbon\Carbon::now()->startOfMonth(), Carbon\Carbon::now()->endOfMonth()])->sum('grand_total')" />
    </div>

    <div class="row p-5 pt-0">
        <div class="col">
            <canvas id="myChart" class="w-100 border"></canvas>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        let ctx = document.querySelector('#myChart');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['', '{!! implode("', '", array_keys($monthlyRevenue)) !!}', ''],
                datasets: [{
                    label: 'Monthly Revenue',
                    backgroundColor: 'grey',
                    borderColor: 'grey',
                    data: [0, {!! implode(', ', $monthlyRevenue) !!}, ],
                }]
            },
            options: {}
        });
    </script>
@endpush
