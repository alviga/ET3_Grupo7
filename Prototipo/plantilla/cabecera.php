
<?php

class cabecera{

    function crear($idioma){


?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ET3</title>

    <!-- Bootstrap Core CSS -->
    <link href=".././css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href=".././css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href=".././css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href=".././font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--CSS and JS Calendar-->
    <link rel="stylesheet" href="../css/calendar.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="../js/es-ES.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/moment.js"></script>
    <script src="../datepicker/js/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="../datepicker/css/bootstrap-datetimepicker.min.css" />
    <script src="../datepicker/js/bootstrap-datetimepicker.es.js"></script>


    <style>
    #col{
    margin-left: 400px;
    }
    </style>
    <!-- jQuery -->
    <script src=".././js/jquery.js"></script>

    <script src=".././js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src=".././js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src=".././js/plugins/morris/raphael.min.js"></script>
    <script src=".././js/plugins/morris/morris.min.js"></script>
    <script src=".././js/plugins/morris/morris-data.js"></script>
    <script src=".././datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">

        $(document).ready(function (){

                $('#example1').datepicker({

                    format: "yyyy-mm-dd"
                });
            });
        function prueba(){
            //alert("dentro");
            document.getElementById("formularioduro").submit();
        }
        function fechacomprobar(){


        }
    </script>
</head>
<body style="background-color: #F4EAD5">

    <div id="wrapper">
       <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: #C6E5D9">
           <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="..\Controlador\MenuPrincipal_Controller.php?principal"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "B.A.M." ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></center></a>
            </div>

            <ul class="nav navbar-left top-nav">
				<li>
                    <a href="MenuPrincipal_Controller.php?idiomas=español"><input type="image" align="right" src="..\Archivos\españa.gif" height="30" width="30"></a>
                </li>
				<li>
                    <a href="MenuPrincipal_Controller.php?idiomas=ingles"><input type="image" align="right" src="..\Archivos\ingles.png" height="30" width="30"></a>
                </li>
                <div class="row vdivide"></li>
            </ul>

			<ul class="nav navbar-right top-nav">
				<li>
					<a href="MenuPrincipal_Controller.php?salir=salir"><i class="fa fa-fw fa-power-off"></i><b><?php echo "LOG OUT"; ?></b></a>
                </li>
            </ul>
            <?php
 }} ?>
