<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = [
        'nombre' => $_POST['nombre'] ?? '',
        'fecha_nac' => $_POST['fecha_nac'] ?? '',
        'genero' => $_POST['genero'] ?? '',
        'fecha_visita' => $_POST['fecha_visita'] ?? '',
        'nombreMedico' => $_POST['nombreMedico'] ?? '',
        'generoMedicamentos' => $_POST['generoMedicamentos'] ?? ''
    ];

    // Se guardará en la misma carpeta que este archivo (Logica/api/)
    $archivo = "dato_paciente.json";

    $contenido = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];
    if (!is_array($contenido)) { $contenido = []; }
    $contenido[] = $data;

    file_put_contents($archivo, json_encode($contenido, JSON_PRETTY_PRINT));

    // Generamos la respuesta visual al usuario
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <body>
        <h2>Guardado correctamente</h2>
        <pre>" . json_encode($data, JSON_PRETTY_PRINT) . "</pre>
        <a href='../../presentacion/index.html'>Volver al formulario</a>
    </body>
    </html>";

} else {
    echo "Error: No se enviaron datos.";
}
?>