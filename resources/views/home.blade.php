
<div id="background_web" style="background-color: red;width: 900px; height: 1000px;">
	@extends('layouts.app')

	@section('content')

	@if ($message = Session::get('message'))
	<div  class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>	
		<strong>{{ $message }}</strong>
	</div>
	@endif

	@endsection

</div>