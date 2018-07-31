

	@extends('layouts.app')

	@section('content')
		
	@if ($message = Session::get('message'))
	<div  class="alert alert-danger" role="alert" style="margin-bottom: 0%">
		<button type="button" class="close" data-dismiss="alert">×</button>	
		<strong>{{ $message }}</strong>
	</div>
	@endif

	<div id="background_web">
	</div>
	@endsection

