<?php
// Obtener las opciones guardadas en ajustes
$options = get_option('efipay_options');

// Verificar si se han guardado las opciones y si existe el API key
if ($options && isset($options['api_key'])) {
    $api_key = $options['api_key'];

    // Crear los parámetros de la solicitud
    $group_id = isset($options['group_id']) ? $options['group_id'] : '';
    $request_url = 'https://efipay-sag.redpagos.co/api/v1/subscriptions/subscription';
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

        // Comprobar si se obtuvieron datos válidos
        if ($data && is_array($data)) {
            ?>
            <div class="container my-5">
            <h2>Suscripciones</h2>

            <table class="table table-primary table-striped mt-5" style="width:100%">
                <thead>
                    <tr>
                        <th>ID Plan</th>
                        <th>ID Suscriptor</th>
                        <th>Prueba Finalización</th>
                        <th>Descuentos Finalización</th>
                        <th>Periodo Cobro Inicio</th>
                        <th>Periodo Cobro Termina</th>
                        <th>Periodo Gracia Termina</th>
                        <th>Cancelado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $subscription) : ?>
                        <tr>
                            <td><?php echo $subscription->subscription_plan_id; ?></td>
                            <td><?php echo $subscription->subscriber_id; ?></td>
                            <td><?php echo $subscription->trial_ends_at; ?></td>
                            <td><?php echo $subscription->discount_ends_at ?? 'N/A'; ?></td>
                            <td><?php echo $subscription->starts_at; ?></td>
                            <td><?php echo $subscription->ends_at; ?></td>
                            <td><?php echo $subscription->grace_ends_at; ?></td>
                            <td><?php echo $subscription->canceled_at ?? 'N/A'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <?php
        } else {
            echo 'No se pudieron obtener los datos de las suscripciones.';
        }
    } else {
        echo 'No se pudo realizar la solicitud a la API.';
    }
} else {
    echo 'No se ha configurado el API key en la página de ajustes.';
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
