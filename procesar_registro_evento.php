<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento Registrado</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <section class="evento-registrado">
            <?php
            // Incluir el archivo que contiene las clases
            require_once 'clases.php';

            // Verificar si la solicitud es un POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Recuperar y sanitizar los datos del formulario
                $descripcion = htmlspecialchars($_POST['descripcion'] ?? '', ENT_QUOTES, 'UTF-8');
                $tipo = htmlspecialchars($_POST['tipo'] ?? '', ENT_QUOTES, 'UTF-8');
                $lugar = htmlspecialchars($_POST['lugar'] ?? '', ENT_QUOTES, 'UTF-8');
                $fecha = htmlspecialchars($_POST['fecha'] ?? '', ENT_QUOTES, 'UTF-8');
                $hora = htmlspecialchars($_POST['hora'] ?? '', ENT_QUOTES, 'UTF-8');

                // Validar que los campos no estén vacíos
                if (!empty($descripcion) && !empty($tipo) && !empty($lugar) && !empty($fecha) && !empty($hora)) {
                    // Crear una instancia de la clase Evento
                    $nuevoEvento = new Evento($descripcion, $tipo, $lugar, $fecha, $hora);

                    // Mostrar los datos del evento recién creado
                    echo "<h1>Evento Registrado con Éxito</h1>";
                    echo $nuevoEvento->obtenerInfo();
                    echo "<p><a href='index.html'>Volver a la página principal</a></p>";
                } else {
                    echo "<h1>Error en el Registro</h1>";
                    echo "<p>Por favor, completa todos los campos del formulario.</p>";
                    echo "<p><a href='index.html#registro-evento'>Volver al formulario de registro</a></p>";
                }
            } else {
                // Redirigir si no se accede a través del formulario
                header('Location: index.html');
                exit;
            }
            ?>
        </section>
    </div>
</body>
</html>