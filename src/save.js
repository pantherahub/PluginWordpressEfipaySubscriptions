import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function Save({ attributes }) {
    const blockProps = useBlockProps.save();
    return (
        <div {...blockProps}>
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

