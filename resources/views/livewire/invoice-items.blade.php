<div>
    <div class="row mb-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 30%;">Inventory Name</th>
                    <th style="width: 15%;">UoM</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Disc</th>
                    <th>HSN</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @for($i = 0; $i < $count; $i++)
                <tr>
                    <td><x-input-select id="{{$i}}.inventory_id" event="true" :data="$inventories"/></td>
                    <td><x-input-select id="{{$i}}.unit_id" :data="$units"/></td>
                    <td><x-input-text id="{{$i}}.qty"/></td>
                    <td><x-input-text id="{{$i}}.rate"/></td>
                    <td><x-input-text id="{{$i}}.disc"/></td>
                    <td><x-input-text id="{{$i}}.hsn" maxlength="8"/></td>
                    <td>
                        @if($i == $count - 1)
                            <button wire:click.prevent="addItem" class="btn btn-success py-0 px-1">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            @if($i != 0)
                                <button wire:click.prevent="removeItem({{$i}})" class="btn btn-danger py-0 px-1">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            @endif
                        @endif
                    </td>
                </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
