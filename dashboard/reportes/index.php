<?php


session_start();


if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funciones.php');
include ('../../includes/funcionesReferencias.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Reportes",$_SESSION['refroll_predio'],'');

$resEquipos = $serviciosReferencias->traerEquipos();
$cadRefE = $serviciosFunciones->devolverSelectBox($resEquipos,array(1,2),' - ');


?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Gesti&oacute;n: AIF</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">

		
	</style>
    
   
   <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../../js/jquery.mousewheel.js"></script>
      <script src="../../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3>Reportes</h3>

    <div class="boxInfoLargo tile-stats stat-til tile-white">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte Condición de Jugador</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
            	<div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Seleccione el Equipo</label>
                    <div class="input-group col-md-12">
                    	<select id="refequipo" class="form-control" name="refequipo">
							<?php echo $cadRefE; ?>
                    	</select>
                    </div>
                </div>
                
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                    	<ul class="list-inline">
                        	<li>
                    			<button type="button" class="btn btn-success" id="rptCJ" style="margin-left:0px;">Generar</button>
                            </li>
                            <!--<li>
                        		<button type="button" class="btn btn-default" id="rptCJExcel" style="margin-left:0px;">Generar Excel</button>
                            </li>-->
                        </ul>

                </div>
                

            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>

            </form>
    	</div>
    </div>
    
    
    

    
    
   
</div>


</div>

<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	function traerClientesPorEmpresa(idEmpresa) {
		$.ajax({
				data:  {idEmpresa: idEmpresa,
						accion: 'traerClientesPorEmpresa'},
				url:   '../../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
						$('#refcliente1').html(response);
						
				}
		});
	}
	
	$('#refempresa4').change(function(e) {
		traerClientesPorEmpresa($(this).val());	
	});
	

	
	$("#rptCJ").click(function(event) {
        window.open("../../reportes/rptCondicionJugador.php?id=" + $("#refequipo").val() ,'_blank');	
						
    });
	
	
	$("#rptsc").click(function(event) {
        window.open("../../reportes/rptSaldosClientes.php?idEmp=" + $("#refempresa2").val() + "&fechadesde=" + $("#fechadesde2").val()+ "&fechahasta=" + $("#fechahasta2").val(),'_blank');	
						
    });
	
	$("#rptscc").click(function(event) {
        window.open("../../reportes/rptSaldosPorClientes.php?idEmp=" + $("#refempresa4").val() + "&idClie=" + $("#refcliente1").val() + "&fechadesde=" + $("#fechadesde3").val()+ "&fechahasta=" + $("#fechahasta3").val(),'_blank');	
						
    });
	
	$('#rptcc').click(function(e) {
        window.open("../../reportes/rptSaldosEmpresa.php?fechadesde=" + $("#fechadesde4").val()+ "&fechahasta=" + $("#fechahasta4").val(),'_blank');
    });
	
	$("#rpt5").click(function(event) {
        window.open("../../reportes/rptSaldosClientesEmpresas.php?idClie=" + $("#refcliente5").val() + "&fechadesde=" + $("#fechadesde5").val()+ "&fechahasta=" + $("#fechahasta5").val(),'_blank');	
						
    });
	
	
	$("#rpt6").click(function(event) {
        window.open("../../reportes/rptSociosEmpresas.php",'_blank');	
						
    });
	
	$("#rpt7").click(function(event) {
        window.open("../../reportes/rptSocios.php",'_blank');	
						
    });

	
	
	
	
	$("#rptgfExcel").click(function(event) {
        window.open("../../reportes/rptFacturacionGeneralExcel.php?id=" + $("#refempresa1").val() + "&fechadesde=" + $("#fechadesde1").val()+ "&fechahasta=" + $("#fechahasta1").val(),'_blank');	
						
    });
	
	$("#rptscExcel").click(function(event) {
        window.open("../../reportes/rptSaldosClientesExcel.php?idEmp=" + $("#refempresa2").val() + "&fechadesde=" + $("#fechadesde2").val()+ "&fechahasta=" + $("#fechahasta2").val(),'_blank');	
						
    });
	
	$("#rptsccExcel").click(function(event) {
        window.open("../../reportes/rptSaldosPorClientesExcel.php?idEmp=" + $("#refempresa4").val() + "&idClie=" + $("#refcliente1").val() + "&fechadesde=" + $("#fechadesde3").val()+ "&fechahasta=" + $("#fechahasta3").val(),'_blank');	
						
    });
	
	$('#rptccExcel').click(function(e) {
        window.open("../../reportes/rptSaldosEmpresaExcel.php?fechadesde=" + $("#fechadesde4").val()+ "&fechahasta=" + $("#fechahasta4").val(),'_blank');
    });
	
	$("#rpt5Excel").click(function(event) {
        window.open("../../reportes/rptSaldosClientesEmpresasExcel.php?idClie=" + $("#refcliente5").val() + "&fechadesde=" + $("#fechadesde5").val()+ "&fechahasta=" + $("#fechahasta5").val(),'_blank');	
						
    });
	
	$("#rpt6Excel").click(function(event) {
        window.open("../../reportes/rptSociosEmpresasExcel.php",'_blank');	
						
    });
	
	$("#rpt7Excel").click(function(event) {
        window.open("../../reportes/rptSociosExcel.php",'_blank');	
						
    });

});
</script>
<script type="text/javascript">
/*
$('.form_date').datetimepicker({
	language:  'es',
	weekStart: 1,
	todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	startView: 2,
	minView: 2,
	forceParse: 0,
	format: 'dd/mm/yyyy'
});
*/
</script>

<script>
  $(function() {
	  $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
 
    $( "#fechadesde1" ).datepicker();
    $( "#fechadesde1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde2" ).datepicker();
    $( "#fechadesde2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde3" ).datepicker();
    $( "#fechadesde3" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde4" ).datepicker();
    $( "#fechadesde4" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde5" ).datepicker();
    $( "#fechadesde5" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	
	$( "#fechahasta1" ).datepicker();
    $( "#fechahasta1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta2" ).datepicker();
    $( "#fechahasta2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta3" ).datepicker();
    $( "#fechahasta3" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta4" ).datepicker();
    $( "#fechahasta4" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta5" ).datepicker();
    $( "#fechahasta5" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
  });
  </script>
<?php } ?>
</body>
</html>
