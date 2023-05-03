<?php
// Verificar que se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los valores de los campos del formulario
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $msj = trim($_POST["msj"]);

    // Validar los valores recibidos
    if (empty($nombre) || empty($correo) || empty($msj)) {
        // Si algún campo está vacío, mostrar un mensaje de error
        $error = "Por favor, complete todos los campos del formulario.";
    } else if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Si el correo electrónico no es válido, mostrar un mensaje de error
        $error = "El correo electrónico ingresado no es válido.";
    } else {
        // Si los datos son válidos, enviar el correo electrónico
        $destinatario = "sergioeduardoch@gmail.com";
        $asunto = "Mensaje de contacto";

        $mensaje = "De: $nombre\n";
        $mensaje .= "Correo: $correo\n\n";
        $mensaje .= "Mensaje:\n$msj";

        $enviado = mail($destinatario, $asunto, $mensaje);

        if ($enviado) {
            // Si el correo electrónico se ha enviado correctamente, mostrar un mensaje de éxito
            $exito = "¡Gracias por su mensaje! Nos pondremos en contacto con usted lo antes posible.";
        } else {
            // Si ha habido un error al enviar el correo electrónico, mostrar un mensaje de error
            $error = "Ha ocurrido un error al enviar el mensaje. Por favor, inténtelo de nuevo más tarde.";
        }
    }
} else {
    // Si no se ha enviado el formulario, redirigir a la página de inicio
    header("Location: index.html");
    exit;
}
?>
