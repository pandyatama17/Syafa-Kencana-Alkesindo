@extends('layouts.sidebar')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
   @include('layouts.crumbs')
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="wrapper wrapper-content">
         <div class="box animated fadeInUp">
            @yield('list')
         </div>
      </div>
   </div>
</div>
@endsection
