import { __ } from '@wordpress/i18n';
import { useBlockProps, isBootstrapStyles } from '@wordpress/block-editor';
import { Button, SelectControl } from '@wordpress/components';

export default function Save({ attributes }) {
    // Deserializar los atributos del bloque para obtener la información de los planes
    const plans = attributes.plans ? JSON.parse(attributes.plans) : [];

    return (
        <div { ...useBlockProps.save() }>
            {/* Renderizar los planes */}
            <div className="plans-container">
				<div>Hola</div>
                {plans.map(plan => (
                    <div className="plan-card" key={plan.id}>
                        <h3 className="plan-name">{plan.name}</h3>
                        <p className="plan-description">{plan.description}</p>
                        <p className="plan-price">Precio: {plan.price}</p>
                        <Button isPrimary href={plan.checkout_url} target="_blank">
                            {__('Suscribirse', 'efipay-suscriptions')}
                        </Button>
                    </div>
                ))}
            </div>
        </div>
    );
}

