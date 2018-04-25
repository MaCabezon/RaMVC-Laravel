@extends('layouts.app')
@section('content')



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src=" https://code.highcharts.com/modules/exporting.js"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

<script type="text/javascript">
$(function() {
  $('#container').highcharts( <?php echo json_encode($chartarray) ?>)
});
</script>

<div class="container ">
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Asistenica Global</div>
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Asistenica Global</div>
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection