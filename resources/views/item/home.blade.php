@extends('layouts.header')

@section('content')
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
      <style media="screen">
         .centerBtn
         {
            border:none;
            transition: .5s;
            border-radius:5px;
            color:white;
         }
         .centerBtn:hover
         {
            box-shadow: 0 5px 15px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
         }
         .nephitris
         {
            background:#27ae60;
         }
         .belizeHole
         {
            background:#2e8ece;
         }
      </style>
	</div>
	  <div class="row">
			<div class="col-lg-12">
				 <div class="wrapper wrapper-content">
					  <div class="box animated fadeInUp">
                    <div class="col-lg-6">
                       <div class="text-center contact-box centerBtn nephitris" data-animation="bounce">
                           <a href="/storage/list">
                              <br>
                              <br>
                              <br>
                              <h2><i class="fa fa-home"></i> Gudang</h2>
                              <br>
                              <br>
                              <br>
                             <div class="clearfix"></div>
                          </a>
                       </div>
                   </div>
                   <div class="col-lg-6">
                       <div class="text-center contact-box centerBtn belizeHole" data-animation="bounce">
                           <a href="/supplier">
                              <br>
                              <br>
                              <br>
                              <h2><i class="fa fa-truck"></i> Supplier</h2>
                              <br>
                              <br>
                              <br>
                             <div class="clearfix"></div>
                          </a>
                       </div>
                   </div>
					  </div>
				 </div>
			</div>
	  </div>
     <script>
        $(document).ready(function()
        {
            $('.centerBtn').hover(function()
            {
               var animation = $(this).attr("data-animation");

               $(this).addClass('animated');
               $(this).addClass(animation);
               return false;
            },
            function()
            {
               var animation = $(this).attr("data-animation");
               $(this).removeClass('animated');
                $(this).removeClass(animation);
            });

        });
    </script>
@endsection
