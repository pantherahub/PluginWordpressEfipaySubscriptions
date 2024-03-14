<?php
// Obtener las opciones guardadas en ajustes
$options = get_option('efipay_options');
date_default_timezone_set('America/Bogota');

// Verificar si se han guardado las opciones y si existe el API key
if ($options && isset($options['api_key'])) {
    $api_key = $options['api_key'];

    // Crear los parámetros de la solicitud
    $group_id = isset($options['group_id']) ? $options['group_id'] : '';
    $request_url = 'https://soporte.efipay.co/api/v1/subscriptions/plan/group/' . $group_id . '/all';
    $request_args = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key
        )
    );

    // Realizar la solicitud a la API
    $response = wp_remote_get($request_url, $request_args);

    // Verificar si la solicitud fue exitosa y si hay una respuesta
    if (!is_wp_error($response) && $response['response']['code'] === 200) {
        // Decodificar la respuesta JSON
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);
        update_option('efipay_plans', $data); 
        update_option('last_updated_plans', date('d/m/Y - g:ia'));

        // Comprobar si se obtuvieron datos válidos
        if ($data && is_array($data)) {
            ?>
            <div class="container my-5">
            <h2>Tus Planes</h2>

            <p>Última actualización: <?php echo get_option('last_updated_plans'); ?></p>

            <table class="table table-primary table-striped mt-3" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Moneda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $plan) : ?>
                        <tr>
                            <td><?php echo $plan->id; ?></td>
                            <td><?php echo $plan->name; ?></td>
                            <td><?php echo $plan->description; ?></td>
                            <td><?php echo $plan->price; ?></td>
                            <td><?php echo $plan->currency_type; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <?php
        } else {
            echo 'No se pudieron obtener los datos de los planes.';
        }
    } else {
        echo 'No se pudo realizar la solicitud a la API.';
    }
} else {
    echo 'No se ha configurado el API key en la página de ajustes.';
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
