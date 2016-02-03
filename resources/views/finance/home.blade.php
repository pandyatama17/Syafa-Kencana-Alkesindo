@extends('item.main')

@section('menu')
    <style media="screen">
        .hai
        {
            height: 80%;
            line-height: 600px;
            text-align: center;
        }
    </style>
    <div class="row">
        <a href="/finance/invoice" style="color:white">
            <div class="btn hai col s5 blue">
                Create Invoice
            </div>
        </a>
        <div class="col s2">&nbsp;</div>
        <a href="/finance/invoices" style="color:white">
            <div class="btn hai col s5 blue">
                Dafter Invoice
            </div>
        </a>
    </div>
@endsection
