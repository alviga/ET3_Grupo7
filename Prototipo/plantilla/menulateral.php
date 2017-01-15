
<!-- MenuLateral -->

<?php

class menulateral{

	function crear($idioma){

		//include('../Modelos/Cuenta_Model.php');

		$info = new Cuenta();

		$infoCuenta = array();

		$infoCuenta = $_SESSION['usuario'];

		$tipo = $info->comprobarTipoCuenta($infoCuenta);

?>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" style="background-color: #C6E5D9">
                    <li class="active">
											  <?php
												if ($tipo[0] == '1'){
												 ?>
                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"></i><b> <?php echo $idioma['Gestion de equipos'];?> </b><i class="fa fa-fw fa-caret-down" id =""></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="..\Controlador\Equipo_Controller.php?Crear"><b><?php echo $idioma['Crear equipo'];?></b></a>
                            </li>
                             <li>
                                <a href="..\Controlador\Equipo_Controller.php?Consultar"><b><?php echo $idioma['Consultar equipos'];?></b></a>
                            </li>

                         </ul>
                        </li>
												<?php
												}
												if ($tipo[0] == '1'){
												 ?>
												 <li>
                         <a href="javascript:;" data-toggle="collapse" data-target="#demo1"></i><b> <?php echo $idioma['Gestion de participantes'];?> </b><i class="fa fa-fw fa-caret-down" id =""></i></a>
                         <ul id="demo1" class="collapse">
                             <li>
                                 <a href="..\Controlador\Participante_Controller.php?Crear"><b><?php echo $idioma["Crear participante"];?></b></a>
                             </li>

                              <li>
                                 <a href="..\Controlador\Participante_Controller.php?Consultar"><b><?php echo $idioma["Consultar participantes por equipo"];?></b></a>
                             </li>

 													 <li>
 															<a href="..\Controlador\Participante_Controller.php?ConsultarSin"><b><?php echo $idioma["Consultar participantes sin equipo"];?></b></a>
 													</li>

 													

                          </ul>
                         </li>
												<?php
												}
												if ($tipo[0] == '1'){
												 ?>
												 <li>
                         <a href="javascript:;" data-toggle="collapse" data-target="#demo2"></i><b> <?php echo $idioma["Gestion de valores"];?> </b><i class="fa fa-fw fa-caret-down" id =""></i></a>
                         <ul id="demo2" class="collapse">
                             <li>
                                 <a href="..\Controlador\Valores_Controller.php?Baja"><b><?php echo $idioma["Borrar valor"];?></b></a>
                             </li>
                          </ul>
                         </li>
												<?php
												}
												 ?>
												<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo3"></i><b> <?php echo $idioma["Gestion de compras"];?> </b><i class="fa fa-fw fa-caret-down" id =""></i></a>
                        <ul id="demo3" class="collapse">
                            <li>
                                <a href="..\Controlador\Compra_Controller.php?Crear"><b><?php echo $idioma["Crear compra"];?></b></a>
                            </li>
                            <li>
                                <a href="..\Controlador\Compra_Controller.php?Consultar"><b><?php echo $idioma["Consultar compras"];?></b></a>
                            </li>
                         </ul>
                        </li>
												<?php
												if ($tipo[0] == '0'){
												 ?>
												<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo2"></i><b> <?php echo $idioma["Gestion de inventario"];?> </b><i class="fa fa-fw fa-caret-down" id =""></i></a>
                        <ul id="demo2" class="collapse">
                            <li>
                                <a href="..\Controlador\Inventario_Controller.php?Consultar"><b><?php echo $idioma["Consultar inventario"];?></b></a>
                            </li>
                         </ul
                        </li>
												<?php
												}
												 ?>
												 <li>
                         <a href="javascript:;" data-toggle="collapse" data-target="#demo4"></i><b> <?php echo $idioma["Gestion de ventas"];?> </b><i class="fa fa-fw fa-caret-down" id =""></i></a>
                         <ul id="demo4" class="collapse">
                             <li>
                                 <a href="..\Controlador\Venta_Controller.php?Crear"><b><?php echo $idioma["Crear venta"];?></b></a>
                             </li>

 							 <li>
                                     <a href="..\Controlador\Venta_Controller.php?Consultar1"><b><?php echo $idioma["Consultar ventas vendidas"];?></b></a>
                             </li>
 							<li>
                                 <a href="..\Controlador\Venta_Controller.php?Consultar2"><b><?php echo $idioma["Consultar ventas pendientes"];?></b></a>
                             </li>
                          </ul>
                         </li>
												<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo5"></i><b> <?php echo $idioma["Gestion de balances"];?> </b><i class="fa fa-fw fa-caret-down" id =""></i></a>
                        <ul id="demo5" class="collapse">
                            <li>
                                <a href="..\Controlador\Balances_Controller.php?Alta"><b><?php echo $idioma["Crear balance"];?></b></a>
                            </li>
                            <li>
                                <a href="..\Controlador\Balances_Controller.php?Baja"><b><?php echo $idioma["Borrar balance"];?></b></a>
                            </li>

                             <li>
                                <a href="..\Controlador\Balances_Controller.php?Consultar"><b><?php echo $idioma["Consultar balance"];?></b></a>
                            </li>

                         </ul>
                        </li>
                    </li>
                </ul>
            </div>
        </nav>

<?php
 }
}?>
        <!-- /#page-wrapper -->
