
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src=" https://code.highcharts.com/modules/exporting.js"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

<script type="text/javascript">
$(function() {

     var data=  <?php echo json_encode($chartarray) ?>
     
    
         $('#container').highcharts(data[0])
         $('#container2').highcharts(data[1])    
         $('#container3').highcharts(data[2])
    
    
 
 
});
</script>

<div class="container ">
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Asistencia por Clase</div>
                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Asistencia Global</div>
                <div class="panel-body">
                    <div id="container2"></div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Asistencia en Beca</div>
                <div class="panel-body">
                    <div id="container3"></div>
                </div>
            </div>
        </div>
        

    </div>
</div>
