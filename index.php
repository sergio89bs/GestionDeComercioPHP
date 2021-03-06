<!-- CÓDIGO PHP -->
<!-- condicion para obtener la variable con con el nombre de usuario -->
<?php 
if(isset($_GET['usuario']))
$nombreUsuario=$_GET['usuario'];
?>

<!-- CÓDIGO HTML -->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.css"> 
        <link rel="stylesheet" href="css/estilos.css">   
        <title>Login User</title>
    </head>
    <body>
        <br><br><br>
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-4"></div>
    			<div class="col-sm-4">
    				<div style="height: 200px" class="panel panel-primary">
    					<div class="panel panel-heading">Gestión de Comercio</div>
    					<div class="panel panel-body">
    					     
    					    <!-- formulario del login que manda lod datos al archivo login.php -->
    						<form method="post" action="EnviosPOST/login.php">
    							<label>Usuario</label>                          
    							<input type="text" class="form-control input-sm" name="usuario" required>
    							<label style="margin-top: 5px;">Email</label>
    							<input type="email"class="form-control input-sm" name="email" required>
                                <br>                           
    							<button type="submit" class="btn btn-primary btn-sm">Entrar</button> 
    							 <!--Login del usuario-->
                                <?php if(isset($_GET['conectado'])){ if($_GET['conectado']==1){echo"
                                <div class='mensajeLogin'> <h4>Bienvenido $nombreUsuario</h4></div>                          
                                ";}else{echo"
                                <div class='mensajeLogin'> <h4>Ingrese un usuario valido</h4></div>    
                                ";}}?>
    							<!-- se verifica que el usuario es correcto para poder continuar con la variable conectado -->
                                <?php if(isset($_GET['conectado']))if($_GET['conectado']==1):     ?>
                                <button type='button' onclick="location.href='acceso.php'" class='btn btn-danger btn-sm'>Continuar</button>
                                <?php endif ?>
                            </form>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm-4"></div>
    		</div>
    	</div>                                          
    </body>
</html>