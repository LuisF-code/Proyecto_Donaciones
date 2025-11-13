<?php
// donar.php
// Iniciar sesión (opcional, pero buena práctica si se necesita persistir datos)
session_start();

function simularDonacionSegura($nombre, $email, $monto) {
    // 1. Validar los datos de entrada
    if (empty($nombre) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !is_numeric($monto) || $monto <= 0) {
        return [
            'success' => false,
            'message' => 'Por favor, completa todos los campos correctamente. El monto debe ser un número positivo.'
        ];
    }

    // 2. Sanitizar los datos para prevenir ataques de inyección
    $nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $monto = floatval($monto);

    // 3. Simular el proceso de donación
    // En un entorno real, aquí se integraría una pasarela de pago real (ej. Stripe, PayPal).
    
    // Devolver una respuesta de éxito
    return [
        'success' => true,
        'message' => "¡Gracias, $nombre! Tu donación de $$monto ha sido procesada con éxito. Recibirás un correo de confirmación en $email."
    ];
}

// 4. Verificar si la solicitud es un POST
$respuesta = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $monto = $_POST['monto'] ?? '';
    
    $respuesta = simularDonacionSegura($nombre, $email, $monto);
} else {
    // Si no es un POST, devolver un error
    $respuesta = [
        'success' => false,
        'message' => 'Método de solicitud no válido.'
    ];
}

// 5. Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($respuesta);
exit;

?>
