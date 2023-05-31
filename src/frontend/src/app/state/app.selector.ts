import {createSelector} from '@ngrx/store';
import {SimpleGallery} from '../models/simple_gallery';

export const galleriesFeature = (state) => state.app.galleries;

export const getSubGalleries = (props: {id: number}) => createSelector(
	galleriesFeature,
	(galleries) => {
		if (galleries === undefined)
			return [];

		let subGalleries: SimpleGallery[] = [];
		let k: keyof typeof galleries;
		for (k in galleries) {
			let gallery: SimpleGallery = galleries[k];

			if (gallery.parentId == props.id)
				subGalleries.push(gallery);
		}

		return subGalleries;
	}
);
