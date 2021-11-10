<?php

session_start();
$rol=null;
$roles =null;
// VALIDACION DE USUARIO
if($_SESSION['username']){}
else{
header("location:../index.php");
}
		   
		
//CONEXION A LA BASE DE DATOS PARA CONOCER LOS USUARIOS SUPERADMIN
require_once "../conections/BaseDatos.php";
$c= new conectar();
$conexion=$c->conexion();
$sqlAdmin="SELECT FullName FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin";
$super=mysqli_query($conexion,$sqlAdmin);
while ($superAdmin=mysqli_fetch_row($super)){
	if($superAdmin[0] == $_SESSION['username']){
	$roles=2;
	}
}
//CONDICIONAL PARA CREAR LA VARIABLE CON EL VALOR DE ROL


if(isset($_SESSION['rol'])){

if(($_SESSION['rol']==0) && ($roles==2)){

$rol=2;
}else{
if($_SESSION['rol']==0){
	$rol =0;
	
}else{
	$rol=1;

}
}
}



            //PETICION A LA BASE DE DATOS PARA OBTENER LOS REGISTROS DE LOS ARTICULOS
			// require_once "../conections/BaseDatos.php";
			$co= new conectar();
			$conexion=$co->conexion();		
            
			//PARA OBTENER EL NUMERO DE REGISTROS TOTALES
			$sqlTotalRegistros="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID";
			$result=mysqli_query($conexion,$sqlTotalRegistros);
            $numFilas=mysqli_num_rows($result);
           
			$pagina =1;
			$mostrar=10;
			$totPaginas=$numFilas/$mostrar;
			$inicioPaginas=($pagina - 1) * $totPaginas;
			$sqlLIMIT="SELECT * FROM category INNER JOIN product ON category.CategoryID = product.CategoryID LIMIT $inicioPaginas,$mostrar";
			$result=mysqli_query($conexion,$sqlLIMIT);
			
			?>
			
				 
	

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.css">
	<script src="../libraries/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="../css/estilos.css"> 
    <title>Document</title>
</head>
<body>
    <?php echo "HOLAAAA $totPaginas and $rol"; ?> 
	<button class="btn-lg btn-primary botCrear">Crear nuevo producto</button>
 <table class="table table-bordered table-active" style="text-align: center;">
	<caption><label class="titulo-seccion">Articulos</label></caption>
	<tr>
		<td class="bg-primary"><button name="bot" value="" id="boNombre" class="btn btn-primary">ID</button></td>
		<td class="bg-primary"><button name="bot" value="" id="boNombre" class="btn btn-primary">Categoria</button></td>
		<td class="bg-primary"><button name="boNombre" value="" id="boNombre" class="btn btn-primary">Nombre</button></td>
		<td class="bg-primary"><button name="bot" value="" id="boNombre" class="btn btn-primary">Coste</button></td>
		<td class="bg-primary"><button name="bot" value="" id="boNombre" class="btn btn-primary">Precio</button></td>
		<?php if($rol==2): ?>
			<?php echo "
		<td class='bg-primary'>Editar</td>
		"?>
		<?php endif ?>
		<?php if($rol ==2): ?>
			<?php echo"
	    <td class='bg-primary'>Eliminar</td>"?>
		<?php endif ?>
	</tr>
    <?php
   
	while ($ver=mysqli_fetch_row($result)):
	 ?>
	 
				
	<tr>
		<td class="td-white"><?php echo $ver[2] ?></td>
		<td class="td-white"><?php echo $ver[1] ?></td>
		<td class="td-white"><?php echo $ver[3] ?></td>
		<td class="td-white"><?php echo $ver[4] ?></td>
		<td class="td-white"><?php echo $ver[5] ?></td>
		<?php if($rol ==2): ?>
			<?php echo"
		<td class='td-white editar'>
			<span class='btn btn-warning btn-xs' data-toggle='modal' data-target='#actualizaCategoria'>
				<span class='glyphicon glyphicon-pencil'></span>
			</span>
		</td>" ?>
		<?php endif ?>
		<?php if($rol==2): ?>
			<?php echo "
		<td class='td-white'>
			<span class='btn btn-danger btn-xs' >
				<span class='glyphicon glyphicon-remove'></span>
			</span>
		</td>" ?>
		<?php endif ?>
	</tr>
    <?php endwhile; 
    ?>
</table>
<nav aria-label="Page navigation example" style="text-align: center;">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Anterior</a></li>

	<?php for($i=0;$i<$totPaginas;$i++): ?>
	<li class="page-item"><a class="page-link" href="#"><?php echo "$i" + 1 ?></a></li>
    <?php endfor ?>
  
    <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
  </ul>
</nav> 
<button type="button" class="botPosition btn-lg btn-primary" onclick="location.href='../acceso.php'">Volver</button>
</body>

<!-- PRUEBA DE POST -->
<script>
let valor ='hola vengo de js';
</script>
<?php 
$var_php = "<script> document.writeln(valor); </script>";
echo "$var_php";
?>
</html>
  