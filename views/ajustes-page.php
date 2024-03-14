<?php
// ajustes-page.php

// Comprueba si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Guarda o actualiza los campos en las opciones del plugin
    update_option('efipay_options', $_POST);
    echo '<div class="updated"><p>Opciones guardadas correctamente.</p></div>';
}

// Obtiene las opciones actuales del plugin
$options = get_option('efipay_options', array());

?>

<div class="wrap container">
    <div class="my-5">
        <h2>Ajustes de Efipay</h2>
        <p>Aqui llenarás todos los campos requeridos para el correcto funcionamiento de la pasarela de pago.</p>
    </div>
    <form method="post" action="">
        <div class="form-group row">
            <label for="api_key" class="col-sm-3 col-form-label">API Key</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="api_key" name="api_key" value="<?php echo isset($options['api_key']) ? esc_attr($options['api_key']) : ''; ?>">
                <small id="apiKeyHelp" class="form-text text-muted">Llave que sirve para encriptar la comunicación con Efipay.</small>
            </div>
        </div>
        <div class="form-group row">
            <label for="group_od" class="col-sm-3 col-form-label">ID del grupo de planes</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="group_id" name="group_id" value="<?php echo isset($options['group_id']) ? esc_attr($options['group_id']) : ''; ?>">
                <small id="GroupIdHelp" class="form-text text-muted">ID del grupo donde estan tus planes de efipay</small>
            </div>
        </div>
        <div class="form-group row mt-4">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </form>
</div>




<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">