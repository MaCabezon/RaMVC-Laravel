@extends('layouts.app')
@section('content')


<script type="text/javascript">
    $(function () { 
        
        var data_numeroAlumnos = <?php echo $numeroAlumnos; ?>;

    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Yearly Website Ratio'
        },
        xAxis: {
            categories: ['2013','2014','2015', '2016']
        },
        yAxis: {
            title: {
                text: 'Rate'
            }
        },
        series: [ {
            name: 'View',
            data: data_numeroAlumnos
        }]
    });
});
</script>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection