import {createReducer, on} from '@ngrx/store';
import {galleryLoadedAction} from './gallery.action';
import {Gallery} from '../gallery.model';

export interface GalleryState {
	gallery: Gallery
}

const initialState = {
	gallery: {
		id: 0,
		name: '',
		thumbId: 0,
		parentId: 0,
		parentGalleryId: 0,
		tagIdList: [],
		description: '',
		useTags: true,
		combinedView: false,
	}
};

export const galleryReducer = createReducer<GalleryState>(
	initialState,
	on(galleryLoadedAction, (state: GalleryState, data) => {
		var val = {
			gallery: {...state.gallery}
		};
		val.gallery = {...data.gallery};
		return val;
	})
);
