<?php
// Datos de conexión a Airtable
$api_key = 'TU_API_KEY';
$base_id = 'ID_DE_TU_BASE';
$table_name = 'Nombre_de_tu_tabla';

// Obtener identificación del formulario
$identificacion = $_POST['identificacion'];

// URL de la solicitud a Airtable para obtener los datos del estudiante por identificación
$url = "https://api.airtable.com/v0/{$base_id}/{$table_name}?filterByFormula=({identificacion}='{$identificacion}')";

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
    $correo = $data['records'][0]['fields']['correo'];
    echo "El correo asociado a la identificación $identificacion es: " . $correo;
} else {
    echo "No se encontró ningún correo asociado a la identificación $identificacion";
}
?>
