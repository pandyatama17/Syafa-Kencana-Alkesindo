
@extends('layouts.header')

@section('content')
	@if(Session::has('user'))
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-4">
			<h2>Home</h2>
				<ol class="breadcrumb">
					<li>
						<a href="{{url()}}">SKA</a>
					</li>
					<li class="active">
						<strong>Home</strong>
					</li>
				</ol>
		</div>
		{{-- <div class="col-sm-8">
			<div class="title-action">
				<a href="" class="btn btn-primary">This is action area</a>
			</div>
		</div> --}}
	</div>
	  <div class="row">
			<div class="col-lg-12">
				 <div class="wrapper wrapper-content">
				 @endif
					  <div class="middle-box text-center animated fadeIn">
							{{-- <h3 class="font-bold">This is page content</h3> --}}

							<div class="error-desc">
								 <img src="{{asset('/SKA_Logo.png')}}" alt="SKA LOGO" style="background: #F3F3F4; width:100%; height:100%" />
							</div>
					  </div>
					  @if(Session::has('user'))
				 </div>
			</div>
	  </div>
  @endif
@endsection
