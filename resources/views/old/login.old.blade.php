@extends('header')

@section('content')
<style>
  form {
	width: 380px;
	margin: 4em auto;
  padding-top: 20px;
	padding: 3px;
	background: #fafafa;
	border: 1px solid #ebebeb;
	box-shadow: rgba(0,0,0,0.14902) 0px 1px 1px 0px,rgba(0,0,0,0.09804) 0px 1px 2px 0px;
  height: 360px;
}

</style>
<div class="row">
  @if(Session::has('message'))
    <script type="text/javascript">
      Materialize.toast("{{Session::get('message')}}", 20000);
    </script>
  @endif
  <div class="col s12">&nbsp;</div>
  <div class="col s4">&nbsp;</div>
  <form class="col s4" action="{!! action('UserController@doLogin') !!}" role="form" method="post">
    <div class="row">
      <div class="col s1">&nbsp;</div>
      <h4 class="header">Login</h4>
      <div class="divider"></div>
      <div class="col s12">&nbsp;</div>
      <div class="col s1">&nbsp;</div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="input-field col s10">
        <input id="username" name="username" type="text" class="validate">
        <label for="username">Username</label>
      </div>
      <div class="clear"></div>
      <div class="col s1">&nbsp;</div>
      <div class="input-field col s10">
        <input id="password" name="password" type="password" class="validate">
        <label for="password">Password</label>
      </div>
    </div>
    <div class="col s12">&nbsp;</div>
    <div class="col s12">&nbsp;</div>
    <button class="btn waves-effect waves-light" type="submit" name="action" style="margin-bottom:20px; float:right; margin-right:20px">
      Login<i class="material-icons right">lock</i>
    </button>
  </form>
</div>
@endsection
