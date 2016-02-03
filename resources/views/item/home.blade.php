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
        <a href="/storage/restock" style="color:white">
            <div class="btn hai col s5 blue">
                Input Barang Masuk
            </div>
        </a>
        <div class="col s2">&nbsp;</div>
        <a href="/storage/out" style="color:white">
            <div class="btn hai col s5 blue">
                Create DO
            </div>
        </a>
    </div>
@endsection
