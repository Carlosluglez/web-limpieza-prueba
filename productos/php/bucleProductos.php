<?php
function crearSelect($conn, $selecQuery)
{
    $stmt = $conn->prepare($selecQuery);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultado = $stmt->fetchAll();

    return $resultado;
}
?>

