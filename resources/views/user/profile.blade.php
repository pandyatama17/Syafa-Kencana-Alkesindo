
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
	</div>
	  <div class="row">
			<div class="col-lg-12">
				 <div class="wrapper wrapper-content">
					  <div class="box animated fadeIn">
							{{-- <h3 class="font-bold">This is page content</h3> --}}

                     <div class="col-md-4">
								<div class="ibox float-e-margins">
                           <div class="ibox-title">
                              <h5>Profil</h5>
                           </div>
                           <div>
                              <div class="ibox-content no-padding border-left-right">
                                 <img alt="image" class="img-responsive" src="{{asset('img/user/'.Session::get('user')->avatar)}}">
                              </div>
                              <div class="ibox-content profile-content">
                              	<h4><strong>{{Session::get('user')->name}}</strong></h4>
                                 <p><i class="fa fa-map-marker"></i> {{Session::get('user')->address}}</p>

											{{-- <p><strong>Username : </strong>{{Session::get('user')->username}}</p>
                                 <p><strong>Tempat/Tgl Lahir : </strong>{{Session::get('user')->username}}</p> --}}
											<table>
												<tr>
													<td><strong>Username</strong></td>
													<td><strong>&nbsp;:&nbsp;</strong></td>
													<td>{{Session::get('user')->username}}</td>
												</tr>
												<tr>
													<td><strong>Level</strong></td>
													<td><strong>&nbsp;:&nbsp;</strong></td>
													<td>{{Session::get('user')->user_level}}</td>
												</tr>
												<tr>
													<td><strong>Tempat/Tgl Lahir</strong></td>
													<td><strong>&nbsp;:&nbsp;</strong></td>
													<td>{{Session::get('user')->birthplace}}, {{Session::get('user')->birthdate}}</td>
												</tr>
												<tr>
													<td><strong>Alamat</strong></td>
													<td><strong>&nbsp;:&nbsp;</strong></td>
													<td>{{Session::get('user')->address}}</td>
												</tr>
											</table>
                                 <div class="row m-t-lg">
                              </div>
                              <div class="user-button">
                              	<div class="row">
                                 	<div class="col-md-6">
                                    	{{-- <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button> --}}
                                    </div>
												<div class="col-md-12">
													<form class="form-horizontal" action="{{action('UserController@updateAvatar')}}" method="post" id="changeAvatarForm">

														<div class="form-group">
															<label class="col-sm-2 control-label">Avatar</label>
															<div class="col-sm-10">
																<input type="file" class="form-control" id="image" name="image">
															</div>
														</div>
														<div class="clearfix"></div>
														<br>
														<div class="col-md-offset-6 col-md-6">
															<input type="hidden" name="_token" value="{{csrf_token()}}">
															<button type="submit" class="btn btn-info btn-sm btn-block"><i class="fa fa-image"></i> Ubah Avatar</button>
														</div>
													</form>
													<div class="image-prev">
														<img src="{{asset('img/user/'.Session::get('user')->avatar)}}" id="prev" class="img-responsive" alt="" />
													</div>
												</div>
											 </div>
										 </div>
                           </div>
                        </div>
                     </div>
                  </div>
						<div class="col-md-8">
							<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ubah Profil</h5>
                            <div class="ibox-tools">
                                <a class="close close-link binded">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal" id="updateInfoForm" method="post" action="{!! action('UserController@profileUpdateInfo') !!}">
                                <p>Ubah profil anda.</p>
										  <input type="hidden" name="username" value="{{Session::get('user')->username}}">
                                <div class="form-group">
											  	<label class="col-lg-2 control-label">Username</label>
                                    <div class="col-lg-10">
													<input type="text" placeholder="Username" class="form-control" value="{{Session::get('user')->username}}" disabled="">
                                    </div>
                                </div>
										  <div class="form-group">
											  	<label class="col-lg-2 control-label">Nama</label>
                                    <div class="col-lg-10">
													<input type="text" placeholder="Nama" class="form-control" value="{{Session::get('user')->name}}" name="name">
                                    </div>
                                </div>
										  {{-- Date Input --}}
		                          <div class="form-group datepicker">
		                             <label class="col-lg-2 control-label">Tanggal Lahir</label>
		                           	<div class="col-lg-10 input-group m-b date">
		                              	<span class="input-group-addon">
		                                 	<i class="fa fa-calendar"></i>
		                                  </span>
		                                  <input type="text" class="form-control" value="{{date('Y-m-d')}}" name="birthdate">
		                              </div>
		                           </div>
											<div class="form-group">
 											  	<label class="col-lg-2 control-label">Tempat Lahir</label>
                                     <div class="col-lg-10">
 													<input type="text" placeholder="Tempat Lahir" class="form-control" value="{{Session::get('user')->birthplace}}" name="birthplace">
                                     </div>
                                 </div>
                                <div class="form-group">
											  <label class="col-lg-2 control-label">Alamat</label>
											 <div class="col-lg-10">
											  	<textarea name="address" placeholder="Alamat" class="form-control" >{{Session::get('user')->address}}</textarea>
											 </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-10 col-lg-2 text-right">
													<input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
						</div>
						<div class="col-md-8">
							<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ubah Password</h5>
                            <div class="ibox-tools">
                                <a class="close close-link binded">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal" id="changePasswordForm" method="post" action="{!! action('UserController@profileChangePassword') !!}">
                                {{-- <p>Ubah profil anda.</p> --}}
                                <div class="form-group">
											  	<label class="col-lg-2 control-label">Password Lama</label>
                                    <div class="col-lg-10">
													<input type="password" name="password_old" class="form-control">
                                    </div>
                                </div>
										  <div class="form-group fg-pass">
											  	<label class="col-lg-2 control-label">Password Baru</label>
                                    <div class="col-lg-10">
													<input type="password" name="password_1" id="password1" class="form-control">
                                    </div>
                                </div>
										  <div class="form-group fg-pass">
											  	<label class="col-lg-2 control-label">Ulangi Password Baru</label>
                                    <div class="col-lg-10">
													<input type="password" name="password_2" id="password2" class="form-control">
													<span id="helperPassword" class="help-block m-b-none">Password tidak sama!</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-10 col-lg-2 text-right">
													<input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
						</div>
					</div>
				 </div>
			</div>
	  </div>
	  <script src="{{asset('assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
	  <script src="{{asset('jquery.validate.min.js')}}"></script>
	  <script src="{{asset('swal/dist/sweetalert.min.js')}}"></script>
	  <script src="{{asset('jquery.form.js')}}"></script>
	  <script type="text/javascript">
	  $(document).ready(function()
	  {
		//   $('#updateInfoForm').validate(
		// 	{
		// 			 rules:
		// 			 {
		// 				  id:
		// 				  {
		// 						required: true
		// 				  },
		// 			  },
		// 			 highlight: function(label)
		// 			 {
		// 				  $(label).closest().addClass('error');
		// 			 },
		// 			 success: function(label)
		// 			 {
		// 				  label.closest().addClass('success');
		// 			 },
		// 			 submitHandler: function(form)
		// 			 {
		// 				  if ($(form).valid())
		// 				  var url = $(this).attr('action');
		// 				  var inputdata = $(this).serialize();
		// 				  var formvar = $(form);
		// 				  {
		// 					  swal(
		// 		           {
		// 						  	title: "Konfirmasi Pengubahan Profil",
		// 	  						text: "Silahkan masukkan password anda ",
		// 		  					type: "input",
		// 		  					showCancelButton: true,
		// 		  					closeOnConfirm: false,
		// 		  					animation: "slide-from-top",
		// 		  					inputPlaceholder: "Silahkan masukkan password anda",
		// 		  					showLoaderOnConfirm: true,
		// 	  				},function(inputValue)
		// 	  				{
		// 						var password = '{{Session::get('user')->password}}';
		// 	  					if (inputValue === false) return false;
		// 	  					if (inputValue != password)
		// 	  					{
		// 	  						swal.showInputError("password salah! ");
		// 	  						return false
		// 	  					}
		// 	  					else
		// 	  					{
		// 							formvar.ajaxSubmit(
		// 							{
		// 								 url: url,
		// 								 type: 'POST',
		// 								 data: inputdata,
		// 								 success: function(data)
		// 								 {
		// 									  var obj = jQuery.parseJSON(data);
		// 									  if(obj.err == false)
		// 									  {
		// 											swal(
		// 											{
		// 												 title: "Success!",
		// 												 text: obj.msg,
		// 												 type: "success",
		// 												 confirmButtonColor: "#0288d1",
		// 												 confirmButtonText: "Ok!",
		// 												 closeOnConfirm: false
		// 											},
		// 											function()
		// 											{
		// 												 location.replace('/storage/list');
		// 											});
		// 											}
		// 											else
		// 											{
		// 												 swal("Opps!", obj.msg, "error");
		// 											}
		// 									  }
		// 								})
		// 								return false;
		// 							}
		// 						});
		// 				}
		// 			}
		// 		});
		$('#updateInfoForm').validate(
          {
              rules:
              {
                  username:
                  {
                          required: true
                  },

              },
              highlight: function(label)
              {
                  $(label).closest().addClass('error');
              },
              success: function(label)
              {
                  label.closest().addClass('success');
              },
              submitHandler: function(form)
              {
                  if ($(form).valid())
                  {
                      $(form).ajaxSubmit(
                      {
                          url:$(this).attr('action'),
                          type: 'POST',
                          data: $(this).serialize(),
                          success: function(data)
                          {
                              var obj = jQuery.parseJSON(data);
                              if(obj.err == false)
                              {
                                  swal(
                                  {
                                      title: "Success!",
                                      text: obj.msg,
                                      type: "success",
                                      confirmButtonColor: "#0288d1",
                                      confirmButtonText: "Ok!",
                                      closeOnConfirm: false
                                  },
                                  function()
                                  {
                                      location.replace('/storage/list');
                                  });
                                  }
                                  else
                                  {
                                      swal("Opps!", obj.msg, "error");
                                  }
                              }
                          })
                          return false;
                      }
                  }
              });
	  });
	  $('#changeAvatarForm').validate(
			{
				 submitHandler: function(form)
				 {
					  if ($(form).valid())
					  {
							$(form).ajaxSubmit(
							{
								 url:$(this).attr('action'),
								 type: 'POST',
								 data: $(this).serialize(),
								 success: function(data)
								 {
									  var obj = jQuery.parseJSON(data);
									  if(obj.err == false)
									  {
											swal(
											{
												 title: "Success!",
												 text: obj.msg,
												 type: "success",
												 confirmButtonColor: "#0288d1",
												 confirmButtonText: "Ok!",
												 closeOnConfirm: false
											},
											function()
											{
												 location.reload();
											});
											}
											else
											{
												 swal("Opps!", obj.msg, "error");
											}
									  }
								 })
								 return false;
							}
					  }
				 });
	  $("#helperPassword").hide();
	  function readURL(input)
	  {
			if (input.files && input.files[0])
			{
				var reader = new FileReader();
				reader.onload = function (e)
				{
					$('#prev').attr('src', e.target.result);
					$('#prev').show();
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#image").change(function()
		{
			readURL(this);
		});
		$('#prev').hide();
	  $("#password2").change(function()
	  {
	  		if($(this).val() == $("#password1").val())
			{
				$(".fg-pass").removeClass('has-error');
				$(".fg-pass").addClass('has-success');
				$("#helperPassword").hide();
			}
			else
			{
				$(".fg-pass").removeClass('has-success');
				$(".fg-pass").addClass('has-error');
				$("#helperPassword").show();
			}
	  })
	  $('.datepicker .input-group.date').datepicker({
					  todayBtn: "linked",
					  keyboardNavigation: false,
					  forceParse: false,
					  calendarWeeks: true,
					  autoclose: true,
					  format: 'yyyy-mm-dd'
				 });
	  </script>
@endsection
