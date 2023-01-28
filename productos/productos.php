
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/productosStyle.css">
    <link rel="stylesheet" href="css/formulario_registro.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@100&family=Luxurious+Roman&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/21d67cf8dd.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="js/funciones.js"></script>
    <!-- <script src="js/jquery-3.6.3.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
   
    <title>pagina productos</title>
</head>

<?php

include "php/db_common.php";

if (isset($_POST['alta'])) {

    generarAlta();
} else if (isset($_POST['login'])) {

    generarLogin();
} else if (isset($_POST['logout'])) {
    // cambioCookie();
    destruirSesion();
    
}//else if (isset($_POST['boton_carrito'])) {
   // anadirAlCarrito();
//}
else if (isset($_GET["comprar_id"])){

    anadirAlCarrito();   
}
//var_dump($_SESSION['nif_usu']);

// if (isset($_SESSION['nif_usu'])) {
//     echo "<script>nif_usu='" . $_SESSION['nif_usu'] . "';</script>";

?>

<body>

    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn"><span class="fas fa-bars checkbtn"></span>

        </label>
        <a href="#" class="enlace">
            <img id="logo" class="logo" alt="logo" src="img/logo.jpg">
        </a>

        <ul>
            <li> <a href="../Index.php">Inicio</a></li>
            <li> <a href="productos.php">Productos</a></li>
            <li> <a href="#">Servicios</a></li>
            <li> <a href="#">Contacto</a></li>

            <?php
            session_start(); 
            //si hay sesión iniciada podremos cerrar la sesión desde el boton con name='logaut'
            if (isset($_SESSION['nif_usu'])) {
                if ($_SESSION['nif_usu'] != "") {
                    echo "<li><form action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method='post' ><input type='submit' value='logout' name='logout' id='log_button'></form></li>";
                  //  echo '<script>$("#log_button").on("click",cerrarSesion);</script>';
                    //  echo '<input type="button" id="cerrar_sesion" name="cerrar_sesion" value="Cerrar Sesion"/>';            
                }
                //si no hay sesion iniciada podemos registrarnos o logearnos en la pagina o en la base de datos   
            } else {
                echo "<li><input type='button' value='login' name='login' id='log_button'></li>";             
               // echo '<script>$("#log_button").on("click", mostrarFormularioLogin);</script>';
           
            }

            ?>
              <span class="fa-solid fa-cart-shopping" id="carrito"></span>
        </ul>

    </nav>


    <section class="grid_content">
        <!-- login para logearse una vez que ya se esta registrado -->
        <dialog id="formulario_login">
            <div class="container">
                <div class="login-container">
                    <div class="register">
                        <h2>INICIAR SESION</h2>
                        <!--formulario modal aparece al hacer click en boton login -->
                        <form id="formu_login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <!-- <input type="text" placeholder="NOMBRE" class="nombre" /> -->
                            <input type="text" name="correo" id="correo" placeholder="CORREO" class="correo" value="" />
                            <input type="password" name="pass" id="pass" placeholder="CONTRASEÑA" class="pass" value="" />
                            <input type="submit" class="submit" value="LOGEARSE" name="login" id="logearse" />
                            <!-- <button class="submit" >REGISTRARSE</button> -->
                            <a href="#BOTON" id="boton_registro">REGISTRARSE</a>
                        </form>
                    </div>
                    <!-- para poder logearse con redes sociales(de momento sin funcionalidad) -->
                    <div class="login">
                        <h2>INICIAR SESION</h2>
                        <div class="login-items">
                            <button class="fb"><i class="fab fa-facebook-f"></i>ACCEDER CON FACEBOOK</button>
                            <button class="tw"><i class="fab fa-twitter"></i>ACCEDER CON TWITER</button>
                            <button class="cr"><i class="fas fa-envelope"></i>ACCEDER CON CORREO</button>
                        </div>
                    </div>
                </div>
            </div>
        </dialog>

        <!-- formulario para registrarse en la base de datos -->
        <dialog id="formulario_registro">
            <div class="container">
                <div class="login-container">
                    <div class="register">
                        <h2>REGISTRARSE</h2>
                        <form id="formu_registro" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="text" placeholder="NIF" class="nif" name="nif" value="" required />
                            <input type="text" placeholder="NOMBRE" class="nombre" name="nombre" value="" required />
                            <input type="text" placeholder="APELLIDOS" class="apellidos" name="apellidos" value="" required />
                            <input type="text" placeholder="CONTRASEÑA" class="pass" name="pass" value="" required />
                            <input type="email" placeholder="CORREO" class="correo" name="correo" value="" required />
                            <input type="submit" name="alta" class="submit" value="ACEPTAR" />
                            <!-- <button class="submit" >REGISTRARSE</button> -->
                            <a href="#BOTON" id="boton_cancelar">CANCELAR</a>
                        </form>
                    </div>
                </div>
            </div>
        </dialog>

        <div id="capa_frm_comprar">
            <form id="frm_comprar" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="id_articulo" id="id_articulo" />
                <input type="text" name="cantidad" id="cantidad" />
                <input type="text" name="modo" id="modo" value="comprar" />
            </form>
        </div>


        <?php
        //pintamos la card de los productos con la info que tenemos en bbdd
        include "php/bucleProductos.php";
        $conn = create_conn();
        $productos = crearSelect($conn, "SELECT * from productos");
        // var_dump($productos);
        echo "<div class='contenedor' id='contenedor'>";
        foreach ($productos as $key => $valores) {
        ?>
        <form action="productos.php?comprar_id=<?php echo $valores['id_producto'] ?>" method="post">
            <div>
                <img class="imagenes" src="img/<?php echo $valores['id_producto'] ?>.jpg" alt="fotoProducto">
                <div class="informacion">
                    <p id="nombre_<?php echo $valores['nombre'] ?>" class="nombre"> <?php echo $valores['nombre'] ?></p>
                    <p class="precio"><?php echo $valores['precio'] ?>€</p>

                    <!-- <p><?php echo $valores['descripcion'] ?></p> -->
                    <!-- <input type="number" min="1" max="100" id="cantidad_<?php echo $valores['id_producto'] ?>"> -->
                    <input type="number" min="1" max="100" name="cantidad">
                    
                    <input type="submit" value="añadir al carrito" name="boton_carrito">
                    <!-- <img class="fa-solid fa-cart-shopping"></img> -->

                    
                </div>
            </div>
        </form>
        <?php

        }
        echo "</div>"
        ?>



    </section>

</body>

</html>