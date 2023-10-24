<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>WALOK - Restaurante Oriental</title>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="icon" type="walok" href="./img/favicon.ico">
  <link href="css/header.css" rel="stylesheet" type="text/css">     <!--style.css document-->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300&display=swap" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">     <!--font-awesome-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">  <!--bootstrap-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  <!--googleapis jquery-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  <!--font-awesome-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>                          <!--bootstrap-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>           <!--bootstrap-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>            <!--bootstrap-->
</head>
<body>
 <!---navbar--->   
<nav class="navbar navbar-expand-md navbar-light fixed-top">
        <div class="container">
        <a href="./index.php" class="enlace">
            <img src="img/Logo_Walok.png" alt="" class="logo">
        </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navi">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navi">
                <ul class="navbar-nav mr-auto">
                    <?php
                    //establecer la barra de navegación al iniciar sesión
                    if(isset($_SESSION['user_id'])){ echo'
                    <li class="nav-item">
                        <a class="nav-link" href="reservation.php" >Nueva reserva</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_reservations.php" >Ver reservas</a>
                    </li>';
                    
                    //establecer la barra de navegación al iniciar sesión y el rol de administrador
                    if($_SESSION['role']==2) {   
                    echo'
                    <li class="nav-item">
                        <a class="nav-link" href="schedule.php" >Editar horario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tables.php" >Editar mesas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_tables.php" >Ver mesas</a>
                    </li>';    
                    }
                    }
                    //página principal no registrada en la barra de navegación
                    else { echo'
                    <li class="nav-item">
	                 <a class="nav-link" href="./index.php">Inicio</a>
	             </li>
	            <li class="nav-item">
	                <a class="nav-link" href="./carta.php">Carta</a>
	            </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contacto.php">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./reserva.php">Reserva</a>
                    </li>
                    '; } 
                    ?>
                    
                </ul>
                
                    <?php
                    // Botón de cierre de sesión cuando el usuario está conectado
                    if(isset($_SESSION['user_id'])){
                    echo '
                    <form class="navbar-form navbar-right" action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit" class="btn btn-outline-dark">Cerrar sesión</button>
                    </form>';
                    }
                    else{  
                    echo '
                    <div>
                    <ul class="navbar-nav ml-auto">
			<li ><a data-toggle="modal" data-target="#myModal_reg" style:font-weight: bold;>Registrar</a></li>
			<li><a data-toggle="modal" data-target="#myModal_login">Iniciar sesión</a></li>
                    </ul> 
                    </div>
                    ';} 
                    ?>
              
            </div>
        </div>
</nav>

<div class="container">
  <!-- The Modal -->                          
    <div class="modal fade" id="myModal_login">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Login</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            
            <?php
            if(isset($_GET['error1'])){
        
            //script para que modal aparezca cuando se produce un error
            echo '  <script>
                    $(document).ready(function(){
                    $("#myModal_login").modal("show");
                    });
                    </script> ';
        
        
            //mensajes de error al iniciar sesión
        
            if($_GET['error1'] == "emptyfields") {   
                echo '<h5 class="text-danger text-center">Complete todos los campos. ¡Inténtelo de nuevo!</h5>';
                }
                else if($_GET['error1'] == "error") {   
                echo '<h5 class="text-danger text-center">Se ha producido un error. ¡Inténtelo de nuevo!</h5>';
                }
                else if($_GET['error1'] == "wrongpwd") {   
                    echo '<h5 class="text-danger text-center">Contraseña incorrecta, ¡inténtelo de nuevo!</h5>';
                }
                else if($_GET['error1'] == "error2") {   
                    echo '<h5 class="text-danger text-center">Se ha producido un error. ¡Inténtelo de nuevo!</h5>';
                }
                else if($_GET['error1'] == "nouser") {   
                    echo '<h5 class="text-danger text-center">Nombre de usuario o correo electrónico no encontrado. ¡Inténtelo de nuevo!</h5>';
                    }
                }
            echo'<br>';
            ?>  
            
                    <div class="signin-form">
                    <form action="includes/login.inc.php" method="post">
                        <p class="hint-text" style="color: #3A3A40;">Si ya tiene una cuenta, inicie sesión.</p>
                    <div class="form-group">
                        <input type="text" class="form-control" name="mailuid" placeholder="Usuario o correo electrónico" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="pwd" placeholder="Password" required="required">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login-submit" class="btn btn-dark btn-lg btn-block">Iniciar sesión</button>
                    </div>
                            </form>
                    </div>   
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> 
</div>

    
<div class="container">
  <!-- The Modal -->
    <div class="modal fade" id="myModal_reg">
        <div class="modal-dialog">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Formulario de registro</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>      
            <!-- Modal body -->
                <div class="modal-body">   

                <?php
                if(isset($_GET['error'])){
                    //script para que aparezca el modal cuando se produzca un error 
                    echo '  <script>
                                $(document).ready(function(){
                                $("#myModal_reg").modal("show");
                                });
                            </script> ';


                    //mensajes para errores y éxito --formulario de registro

                    if($_GET['error'] == "emptyfields") {   
                        echo '<h5 class="bg-danger text-center">Complete todos los campos. ¡Inténtelo de nuevo!</h5>';
                    }
                    else if($_GET['error'] == "invalidemailusername") {   
                        echo '<h5 class="bg-danger text-center">¡El nombre de usuario o el correo electrónico ya fueron usados!</h5>';
                    }
                    else if($_GET['error'] == "invalidemail") {   
                        echo '<h5 class="bg-danger text-center">Correo electrónico no válido, ¡inténtelo de nuevo!</h5>';
                    }
                    else if($_GET['error'] == "usernameemailtaken") {   
                        echo '<h5 class="bg-danger text-center">Ya ha sido usado el usuario o el correo electrónico. ¡Inténtelo de nuevo!</h5>';
                    }
                    else if($_GET['error'] == "invalidusername") {   
                        echo '<h5 class="bg-danger text-center">Nombre de usuario no válido. ¡Inténtelo de nuevo!</h5>';
                    }
                    else if($_GET['error'] == "invalidpassword") {   
                        echo '<h5 class="bg-danger text-center">¡Contraseña no válida, por favor vuelva a intentarlo!</h5>';
                    }
                    else if($_GET['error'] == "passworddontmatch") {   
                        echo '<h5 class="bg-danger text-center">La contraseña debe coincidir. ¡Inténtelo de nuevo!</h5>';
                    }
                    else if($_GET['error'] == "error1") {   
                        echo '<h5 class="bg-danger text-center">Ocurrió un error, ¡inténtelo de nuevo!</h5>';
                    }
                    else if($_GET['error'] == "error2") {   
                        echo '<h5 class="bg-danger text-center">Ocurrió un error, ¡inténtelo de nuevo!</h5>';
                    }
                }
                if(isset($_GET['signup'])) { 
                        //script para que modal aparezca cuando sea exitoso
                    echo '  <script>
                                $(document).ready(function(){
                                $("#myModal_reg").modal("show");
                                });
                            </script> ';

                    if($_GET['signup'] == "success"){ 
                        echo '<h5 class="bg-success text-center">¡El registro fue exitoso! ¡Por favor Iniciar sesión!</h5>';
                    }
                }
                echo'<br>';
                ?>
    
                    <!---formulario de registro -->
                    <div class="signup-form">
                        <form action="includes/signup.inc.php" method="post">
                            <p class="hint-text" style="color: #3A3A40;">Crea tu cuenta. Es gratis y solo toma un minuto.</p>
                            <div class="form-group">
                                    <input type="text" class="form-control" name="uid" placeholder="Username" required="required">
                                    <small class="form-text text-muted">El nombre de usuario debe tener entre 4 y 20 caracteres</small>
                            </div>
                            <div class="form-group">
                                    <input type="email" class="form-control" name="mail" placeholder="Email" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="pwd" placeholder="Password" required="required">
                                <small class="form-text text-muted">La contraseña debe tener entre 6 y 20 caracteres</small>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="pwd-repeat" placeholder="Repita la contraseña" required="required">
                            </div>        
                            <div class="form-group">
                                <label class="checkbox-inline"><input type="checkbox" required="required"> Acepto las <a href="#">Condiciones de Uso</a> &amp; <a href="#">Políticas de privacidad.</a></label>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="signup-submit" class="btn btn-dark btn-lg btn-block" >Registrar</button>
                            </div>
                        </form>
                    </div> 	
                </div>        
                <!-- Modal footer -->
                <div class="modal-footer">

                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div> 
            </div>
        </div>
    </div>
</div>
   

