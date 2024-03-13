import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import Edit from './edit';
import save from './save';
import metadata from './block.json';
import { useBlockProps } from '@wordpress/block-editor';
import { useEffect, useState } from 'react';
import { Button, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType(metadata.name, {

	attributes: {
        plans: {
            type: 'array',
			default: [],
        },
		selectedPlans: {
            type: 'array',
			default: [],
        },
    },

	edit: ({ attributes, setAttributes }) => {
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
								<a href={JSON.parse(plan).checkout_url} target="_blank">Suscribirse</a>
							</div>
						);
					})}
				</div>
			</div>
		);
	},
	
	save: ({ attributes }) => {
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
								<a href={JSON.parse(plan).checkout_url} target="_blank">Suscribirse</a>
							</div>
						);
					})}
				</div>
			</div>
		);
	},
});