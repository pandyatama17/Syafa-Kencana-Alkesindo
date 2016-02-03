@extends('header')

@section('content')
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">toc</i>
        </a>
        <ul>
            <li><a class="btn-floating red" href="/storage/list"><i class="material-icons">store</i></a></li>
            <li><a class="btn-floating yellow darken-1" href="/storage/restock"><i class="material-icons">input</i></a></li>
            <li><a class="btn-floating green"  href="/supplier"><i class="material-icons">contacts</i></a></li>
            <li><a class="btn-floating blue"  href="/storage/out"><i class="material-icons">launch</i></a></li>
        </ul>
    </div>
    <div class="col s12">
        @yield('subcontent')
    </div>
@endsection
