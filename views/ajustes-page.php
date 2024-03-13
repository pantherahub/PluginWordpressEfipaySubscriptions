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
        <!-- <div class="form-group row">
            <label for="enabled" class="col-sm-3 col-form-label">Habilitar/Deshabilitar</label>
            <div class="col-sm-9">
                <div class="form-check d-flex align-items-center">
                    <input type="checkbox" class="form-check-input" id="enabled" name="enabled" <?php echo isset($options['enabled']) && $options['enabled'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="enabled">Habilita la pasarela de pago Efipay</label>
                </div>
            </div>
        </div> -->
        <!-- <div class="form-group row">
            <label for="currency" class="col-sm-3 col-form-label">Moneda</label>
            <div class="col-sm-9">
                <select class="form-control" id="currency" name="currency">
                    <option value="COP" <?php echo isset($options['currency']) && $options['currency'] === 'COP' ? 'selected' : ''; ?>>COP</option>
                    <option value="USD" <?php echo isset($options['currency']) && $options['currency'] === 'USD' ? 'selected' : ''; ?>>USD</option>
                    <option value="EUR" <?php echo isset($options['currency']) && $options['currency'] === 'EUR' ? 'selected' : ''; ?>>EUR</option>
                </select>
                <small id="currencyHelp" class="form-text text-muted">Selecciona la moneda con la cual se realizará el pago.</small>
            </div>
        </div> -->
        <div class="form-group row">
            <label for="api_key" class="col-sm-3 col-form-label">API Key</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="api_key" name="api_key" value="<?php echo isset($options['api_key']) ? esc_attr($options['api_key']) : ''; ?>">
                <small id="apiKeyHelp" class="form-text text-muted">Llave que sirve para encriptar la comunicación con Efipay.</small>
            </div>
        </div>
        <!-- <div class="form-group row">
            <label for="token" class="col-sm-3 col-form-label">Token Efipay</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="token" name="token" value="<?php echo isset($options['token']) ? esc_attr($options['token']) : ''; ?>">
                <small id="tokenHelp" class="form-text text-muted">Token que sirve para encriptar la comunicación con Efipay.</small>
            </div>
        </div> -->
        <!-- <div class="form-group row">
            <label for="office_id" class="col-sm-3 col-form-label">Comercio ID</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="office_id" name="office_id" value="<?php echo isset($options['office_id']) ? esc_attr($options['office_id']) : ''; ?>">
                <small id="officeIdHelp" class="form-text text-muted">ID de tu comercio Efipay.</small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-3">Transacciones en modo de prueba</div>
            <div class="col-sm-9">
                <div class="form-check d-flex align-items-center">
                    <input type="checkbox" class="form-check-input" id="test" name="test" <?php echo isset($options['test']) && $options['test'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="test">Habilita las transacciones en modo de prueba</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="response_page" class="col-sm-3 col-form-label">Página de respuesta</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="response_page" name="response_page" value="<?php echo isset($options['response_page']) ? esc_attr($options['response_page']) : ''; ?>">
                <small id="responsePageHelp" class="form-text text-muted">URL de la página mostrada después de finalizar el pago.</small>
            </div>
        </div>
        <div class="form-group row">
            <label for="await_page" class="col-sm-3 col-form-label">Página de espera</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="await_page" name="await_page" value="<?php echo isset($options['await_page']) ? esc_attr($options['await_page']) : ''; ?>">
                <small id="awaitPageHelp" class="form-text text-muted">URL de la página que recibe la respuesta definitiva sobre los pagos.</small>
            </div>
        </div>
        <div class="form-group row">
            <label for="confirmation_page" class="col-sm-3 col-form-label">Página de confirmación</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="confirmation_page" name="confirmation_page" value="<?php echo isset($options['confirmation_page']) ? esc_attr($options['confirmation_page']) : ''; ?>">
                <small id="confirmationPageHelp" class="form-text text-muted">URL de la página que recibe la respuesta definitiva sobre los pagos.</small>
            </div>
        </div> -->
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