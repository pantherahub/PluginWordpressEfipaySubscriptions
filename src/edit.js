import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { useEffect} from 'react';
import { SelectControl } from '@wordpress/components';


export default function Edit({ attributes, setAttributes }) {
		// Función para obtener las opciones de Efipay
		useEffect(() => {
            if(attributes.plans.length === 0 || attributes.plans.length !== efipayPlans.length){
                setAttributes({ plans: efipayPlans || [] });
            }
        })
        
            const blockProps = useBlockProps();
        
            return (
                <div {...blockProps}>
                    <SelectControl
                        multiple
                        label={ __( 'Selecciona los planes a mostrar:' ) }
                        value={ attributes.selectedPlans } 
                        onChange={ ( plans ) => {
                            setAttributes({ selectedPlans: plans });
                        } }
                        options={ attributes.plans.map(plan => ({ value: JSON.stringify(plan), label: plan.name })) }
                        __nextHasNoMarginBottom
                    />
                    <p>Vista previa</p>
                    <div className="plans-container">
                
                        {attributes.selectedPlans && attributes.selectedPlans.map(plan => {
                            return (
                                <div className="plan-card" key={JSON.parse(plan).id}>
                                    <h3 className="plan-name">{JSON.parse(plan).name}</h3>
                                    <p className="plan-description">{JSON.parse(plan).description}</p>
                                    <p className="plan-price">Precio: {JSON.parse(plan).price}</p>
                                    <a href={JSON.parse(plan).checkout_url} target="_blank" rel="noopener">Suscribirse</a>
                                </div>
                            );
                        })}
                    </div>
                </div>
            );
}
