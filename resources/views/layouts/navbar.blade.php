@extends('layouts.head')

@section('navbar')
<body class="top-navigation pace-done gray-bg">
	<div id="wrapper">
		<div class="page-wrapper">
			{{-- Start Nav --}}
			<div class="row border-bottom white-bg">
				<nav class="navbar navbar-static-top" role="navigation">
					<div class="navbar-header">
	                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
	                    <i class="fa fa-reorder"></i>
	                </button>
	                <a href="#" class="navbar-brand">SKA</a>
	            </div>
					<div class="navbar-collapse collapse">
                  <div class="nav navbar-nav">
                     {{-- Navbar Cntent --}}
                  </div>
						<ul class="nav navbar-top-links navbar-right">
							<li>
								<a href="{{url('login')}}"><i class="fa fa-sign-in"></i> Login</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
			{{-- end Nav --}}

			{{-- start page Wrapper --}}
			<div class="wrapper wrapper-container">
				<div class="container">
               @yield('content')
            </div>
			</div>
		</div>
	</div>
</body>
@endsection
