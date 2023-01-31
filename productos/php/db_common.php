<script src="js/jquery-3.6.3.min.js"></script>
<?php
function create_conn()
{
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "sypel";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error: no se ha podido establecer la conexión " . $e->getMessage();
    }

    return $conn;
}

//genera alta de cliente en la bbdd
function generarAlta()
{
    $conn = create_conn();
    try {
        $nif = $_POST['nif'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $pass = $_POST['pass'];
        $correo = $_POST['correo'];

        if ($nif != "") {
            $sql = "INSERT INTO cliente(nif,nombre,apellido,pass,correo)VALUES
        ('$nif','$nombre','$apellidos','$pass','$correo')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
//hace el login en la pagina de productos(luego lo trasladaremos al resto de páginas)
function generarLogin()
{

    $conn = create_conn();

    try {
        $correo = $_POST['correo'];
        $pass = $_POST['pass'];
        $sql = "SELECT nif FROM cliente WHERE correo='$correo' and pass='$pass'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $nif = $stmt->fetchAll();

        if (empty($nif)) {
            echo "<script> alert('los datos no son correctos!!'); </script>";
        } else {
            $_SESSION['nif_usu'] = $nif[0]['nif'];
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function destruirSesion()
{
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_destroy();
}
//creamos el un carrito anonimo
function anadirAlCarrito()
{
    $id_articulo = $_GET["comprar_id"];
    $cantidad = $_POST["cantidad"];
    if (!usuarioLogeado()) {
        if (isset($_COOKIE["carrito_anonimo"])) {

            $carrito = $_COOKIE["carrito_anonimo"]; //recuperamos el valor
            $carrito = unserialize($carrito);
            if (array_key_exists($id_articulo, $carrito)) {
                $carrito[$id_articulo] += intval($cantidad);
            } else {
                $carrito[$id_articulo] = intval($cantidad);
            }
            //var_dump($carrito);
            $serialization = serialize($carrito);
            setcookie("carrito_anonimo", $serialization);
        } else {
            $carrito = array();
            if (array_key_exists($id_articulo, $carrito)) {
                // echo "...".$producto;
                $carrito[$id_articulo] += intval($cantidad);
            } else {
                $carrito[$id_articulo] = intval($cantidad);
            }
            // var_dump($carrito);

            $serialization = serialize($carrito);
            setcookie("carrito_anonimo", $serialization);
        }
    } else {
        echo "hola";
        if (isset($_COOKIE["carrito_sesion" . $_SESSION["nif_usu"]])) {

            $carrito = $_COOKIE["carrito_sesion" . $_SESSION["nif_usu"]]; //recuperamos el valor
            $carrito = unserialize($carrito);
            if (array_key_exists($id_articulo, $carrito)) {
                $carrito[$id_articulo] += intval($cantidad);
            } else {
                $carrito[$id_articulo] = intval($cantidad);
            }
        //    var_dump($carrito);
            $serialization = serialize($carrito);
            setcookie("carrito_sesion" . $_SESSION["nif_usu"], $serialization);
        } else {
            $carrito = array();
            if (array_key_exists($id_articulo, $carrito)) {
                // echo "...".$producto;
                $carrito[$id_articulo] += intval($cantidad);
            } else {
                $carrito[$id_articulo] = intval($cantidad);
            }
         //   var_dump($carrito);

            $serialization = serialize($carrito);
            setcookie("carrito_sesion" . $_SESSION["nif_usu"], $serialization);
        }
    }
}

function usuarioLogeado()
{
    // session_start();
    if (isset($_SESSION['nif_usu'])) {
        return true;
    }
    return false;
}

function destruirCookie()
{
    setcookie('carrito_anonimo', "a", time() - 1);
}
