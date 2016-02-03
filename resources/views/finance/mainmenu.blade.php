@extends('finance.menu')
@section('subcontent')
<ul class="collection with-header">
    <li class="collection-header"><h4>Menu Finance</h4></li>
    <li @if ($page == 'invoice') class="collection-item active" @else class='collection-item' @endif>
        <div>
            Buat Invoice
            <a href="/finance/invoice" class="secondary-content">
              <i class="material-icons">store</i>
            </a>
        </div>
    </li>
    {{-- <li @if ($page == 'restock') class="collection-item active" @else class='collection-item' @endif>
        <div>
            Item Restock
            <a href="/storage/restock" class="secondary-content">
              <i class="material-icons">input</i>
            </a>
        </div>
    </li>
    <li @if ($page == 'supplier') class="collection-item active" @else class='collection-item' @endif>
        <div>
            Supplier
            <a href="/supplier" class="secondary-content">
              <i class="material-icons">contacts</i>
            </a>
        </div>
    </li>
    <li class="collection-item">
        <div>
            Item Out
            <a href="/storage/out" class="secondary-content">
              <i class="material-icons">launch</i>
            </a>
        </div>
    </li> --}}
</ul>
@endsection
