import { __ } from '@wordpress/i18n';
import { useBlockProps, isBootstrapStyles } from '@wordpress/block-editor';
import { useEffect, useState } from 'react';
import { Button, SelectControl } from '@wordpress/components';


// Función para obtener los datos de los planes desde la API
const getPlansData = (token) => {
    const options = getEfipayOptions();
    const url = 'https://soporte.efipay.co/api/v1/subscriptions/plan/group/' + options.group_id + '/all';
    return fetch(url, {
        headers: {
            'Authorization': 'Bearer ' + token
        }
    })
    .then(response => response.json())
    .then(data => data)
    .catch(error => console.error('Error fetching plans data:', error));
};

// Función para obtener las opciones de Efipay
const getEfipayOptions = () => {
    return efipayOptions || {};
};

// Función para obtener la opción de Wordpress

export default function Edit({ attributes, setAttributes }) {
    const [plans, setPlans] = useState([]);
    const [token, setToken] = useState('');
    const [loading, setLoading] = useState(true);
    useEffect(() => {
        // Obtener el token de autorización
        const options = getEfipayOptions();
        setToken(options.api_key);

        // Obtener los datos de los planes
        getPlansData(options.api_key, options.group_id)
            .then(data => {
                setPlans(data);
                setLoading(false);
                // Actualizar los atributos del bloque con la información de los planes
                setAttributes({ plans: JSON.stringify(data) });
            });
   
    }, []);

      

    return (
        <div { ...useBlockProps() }>
            {loading ? (
                <p>Loading...</p>
            ) : (
                <>
                    { (
                        <div className="plans-container">
                            {plans.map(plan => {
                                    return (
                                        <div className="plan-card" key={plan.id}>
                                            <h3 className="plan-name">{plan.name}</h3>
                                            <p className="plan-description">{plan.description}</p>
                                            <p className="plan-price">Precio: {plan.price}</p>
                                            <Button isPrimary href={plan.checkout_url} target="_blank">
                                                {__('Suscribirse', 'efipay-suscriptions')}
                                            </Button>
                                        </div>
                                    );

                                return null;
                            })}
                        </div>
                    )}
                </>
            )}
        </div>
    );
}
