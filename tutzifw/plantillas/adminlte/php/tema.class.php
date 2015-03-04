<?php

class Tema implements TemaBase{

	protected $titulo;
	protected $ruta;
	protected $menu;
	protected $html;

	public function __construct(){	
	}

	public function titulo($titulo){
		$this->titulo=$titulo;
	}

	public function ruta($ruta){
		$this->ruta=$ruta;
	}

	public function menu($menu){
	}

	public function encabezado(){
		$plantilla=RUTA_PLANTILLA_HTML;
	return "<!DOCTYPE html>
	<html>
	<head>
    <meta charset='UTF-8'>
    <title></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href='". RUTA_PLANTILLA_HTML ."bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' type='text/css' />
    <link href='http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."dist/css/AdminLTE.min.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."dist/css/skins/_all-skins.min.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/iCheck/flat/blue.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/morris/morris.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/jvectormap/jquery-jvectormap-1.2.2.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/datepicker/datepicker3.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/daterangepicker/daterangepicker-bs3.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css' rel='stylesheet' type='text/css' />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
    <![endif]-->
  </head>
  <body class='login-page'>
  ";

	}

	public function pie(){

		return "   <!-- jQuery 2.1.3 -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/jQuery/jQuery-2.1.3.min.js'></script>
    <!-- jQuery UI 1.11.2 -->
    <script src='".RUTA_PLANTILLA_HTML."http://code.jquery.com/ui/1.11.2/jquery-ui.min.js' type='text/javascript'></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src='".RUTA_PLANTILLA_HTML."bootstrap/js/bootstrap.min.js' type='text/javascript'></script>    
    <!-- Morris.js charts -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js'></script>
    <script src='".RUTA_PLANTILLA_HTML."plugins/morris/morris.min.js' type='text/javascript'></script>
    <!-- Sparkline -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/sparkline/jquery.sparkline.min.js' type='text/javascript'></script>
    <!-- jvectormap -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' type='text/javascript'></script>
    <script src='".RUTA_PLANTILLA_HTML."plugins/jvectormap/jquery-jvectormap-world-mill-en.js' type='text/javascript'></script>
    <!-- jQuery Knob Chart -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/knob/jquery.knob.js' type='text/javascript'></script>
    <!-- daterangepicker -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/daterangepicker/daterangepicker.js' type='text/javascript'></script>
    <!-- datepicker -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/datepicker/bootstrap-datepicker.js' type='text/javascript'></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js' type='text/javascript'></script>
    <!-- iCheck -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/iCheck/icheck.min.js' type='text/javascript'></script>
    <!-- Slimscroll -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/slimScroll/jquery.slimscroll.min.js' type='text/javascript'></script>
    <!-- FastClick -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src='".RUTA_PLANTILLA_HTML."dist/js/app.min.js' type='text/javascript'></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src='".RUTA_PLANTILLA_HTML."dist/js/pages/dashboard.js' type='text/javascript'></script>

    <!-- AdminLTE for demo purposes -->
    <script src='".RUTA_PLANTILLA_HTML."dist/js/demo.js' type='text/javascript'></script>
  </body>
</html>";

	}

	public function renderizar(){

		return $this->encabezado(). $this->pie();

	}


}