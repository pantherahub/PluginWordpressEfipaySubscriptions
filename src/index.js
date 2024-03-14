import { registerBlockType } from '@wordpress/blocks';
import './style.scss';
import Edit from './edit';
import Save from './save';
import metadata from './block.json';
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

	edit: Edit,
	save: Save
});