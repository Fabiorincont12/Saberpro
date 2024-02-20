<?php
// Datos de conexión a Airtable
$api_key = 'pat7NiF8slEtqShQB.e9aa80b117b098186e66a6736ab9db0871e1d788d5dec89634c4f03d74326087';
$base_id = 'appoXRlwse5BNcjNS';
$table_name = 'Sheet0';

// Obtener identificación del formulario
$identificacion = $_POST['Field 2'];

// URL de la solicitud a Airtable para obtener los datos del estudiante por identificación
$url = "https://api.airtable.com/v0/{$base_id}/{$table_name}?filterByFormula=({Identificacion}='{$identificacion}')";

// Configurar la solicitud HTTP
$options = [
    'http' => [
        'header' => "Authorization: Bearer {$api_key}"
    ]
];

// Realizar la solicitud a Airtable
$response = file_get_contents($url, false, stream_context_create($options));

// Decodificar la respuesta JSON
$data = json_decode($response, true);

// Verificar si se encontraron registros
if (!empty($data['records'])) {
    // Obtener el correo asociado a la identificación
    $correo = $data['records'][0]['Field 2']['correo'];
    echo "El correo asociado a la identificación $identificacion es: " . $correo;
} else {
    echo "No se encontró ningún correo asociado a la identificación $identificacion";
}
?>
