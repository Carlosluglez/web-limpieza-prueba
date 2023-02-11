<?php
session_start();

?>
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
    <link rel="stylesheet" href="css/carrito_compras.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Flavors&family=Koulen&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Flavors&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="js/funciones.js"></script>
    <!-- <script src="js/jquery-3.6.3.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->

    <title>pagina productos</title>
</head>

<?php

include "php/db_common.php";
$conn = create_conn();
if (isset($_POST['alta'])) {

    generarAlta();
} else if (isset($_POST['login'])) {

    generarLogin();
    if (isset($_COOKIE["carrito_anonimo"])) {
        if (usuarioLogeado()) {
            $carrito = $_COOKIE["carrito_anonimo"];
            var_dump($carrito);
            setcookie("carrito_sesion" . $_SESSION["nif_usu"], $carrito);
            destruirCookie();
        }
    }
} else if (isset($_POST['logout'])) {
    // cambioCookie();
    destruirSesion();
} else if (isset($_POST['boton_carrito'])) {
    anadirAlCarrito();
    // var_dump($_COOKIE['carrito_sesion' . $_SESSION["nif_usu"]]);
    header("Location: " . $_SERVER['PHP_SELF']);
}

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
            <li> <a href="../servicios/servicios.html">Servicios</a></li>
            <li> <a href="../contacto/contactos.php">Contacto</a></li>

            <?php
            // session_start(); 
            //si hay sesión iniciada podremos cerrar la sesión desde el boton con name='logaut'
            $nif_usu = "";
            if (isset($_SESSION['nif_usu'])) {
                if ($_SESSION['nif_usu'] != "") {
                    $nif_usu = $_SESSION['nif_usu'];
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
            <span onclick="mostrarCarrito('<?php echo $nif_usu; ?>')" class="fa-solid fa-cart-shopping" id="carrito"></span>
        </ul>

    </nav>
    <div id="intro_productos">
        <h1>ESPECIALISTAS EN PRODUCTOS DE LIMPIEZA ECOLÓGICOS</h1><br>
        <h2>con el mínimo impacto sobre el medio ambiente</h2><br>
        <h3>Rgistrate,compralos a través de la web, nosotros te los llevamos a casa</h3>
    </div>
    <section class="grid_content">
        <!-- login para logearse una vez que ya se esta registrado -->
        <dialog id="formulario_login">
            <div class="container ">
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

        <dialog id="mostrar_carrito">
            <div class="container_carrito">
                <h2>CARRITO</h2>
                <form id="frm_carrito" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <?php
                    if (isset($_COOKIE["carrito_sesion" . $_SESSION["nif_usu"]])) {
                        $carrito = $_COOKIE["carrito_sesion" . $_SESSION["nif_usu"]];
                        $carrito = unserialize($carrito);
                        // var_dump($carrito);
                        echo "<table id='tabla_carrito'>";
                        echo "<thead>";
                        echo "<th>Nombre Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th>";
                        echo "</thead>";
                        $suma = 0;
                        foreach ($carrito as $key => $valor) {

                            $sql = "SELECT * FROM productos WHERE id_producto=$key";

                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $result = $stmt->fetchAll();
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td>" . $result[0]['nombre'] . "</td>";
                            echo "<td>" . $result[0]['precio'] . "</td>";
                            echo "<td>" . $valor . "</td>";
                            echo "<td>" . $result[0]['precio'] * $valor . "</td>";
                            echo "</tr>";
                            echo "</tbody>";
                            $suma += $result[0]['precio'] * $valor;
                        }
                        echo "<tfoot>";
                        echo "<tr>";
                        echo "<td colspan='3'>Total Compra:</td>";
                        echo "<td>" . $suma . "</td>";
                        echo "</tr>";
                        echo "</tfoot>";
                        echo "</table>";
                        echo  '<input type="submit" name="comprar" class="submit" value="COMPRAR" />';
                    } else {
                        echo "no tiene productos en el carro";
                    }
                    ?>

                    <a href="#BOTON" id="boton_cerrar_carrito">CERRAR</a>
                </form>
            </div>
        </dialog>


        <?php
        //pintamos la card de los productos con la info que tenemos en bbdd
        include "php/bucleProductos.php";

        $productos = crearSelect($conn, "SELECT * from productos");
        // var_dump($productos);
        echo "<div class='contenedor element' id='contenedor'>";
        foreach ($productos as $key => $valores) {
        ?>
            <form action="productos.php?comprar_id=<?php echo $valores['id_producto'] ?>" method="post">
                <div class="estiloproductos">
                    <img class="imagenes" src="img/<?php echo $valores['id_producto'] ?>.jpg" alt="fotoProducto">
                    <div class="informacion">
                        <p id="nombre_<?php echo $valores['nombre'] ?>" class="nombre"> <?php echo $valores['nombre'] ?></p>
                        <p class="precio">Precio: <?php echo $valores['precio'] ?>€</p>

                        
                        <!-- <p><?php echo $valores['descripcion'] ?></p> -->
                        <!-- <input type="number" min="1" max="100" id="cantidad_<?php echo $valores['id_producto'] ?>"> -->
                        <input type="number" min="1" max="100" name="cantidad" placeholder="introduce Uds" style="width: 100px;">
                        <input type="submit" value="añadir al carrito" name="boton_carrito" id="boton_añadir_carrito" >
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