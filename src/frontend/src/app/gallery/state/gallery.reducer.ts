import {createReducer, on} from '@ngrx/store';
import * as actions from './gallery.action';
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
	on(actions.galleryLoadedAction, (state: GalleryState, data) => {
		var val = {
			gallery: {...state.gallery}
		};
		val.gallery = {...data.gallery};
		return val;
	}),
	on(actions.setHomePageAction, (state: GalleryState) => {
		var val = {
			gallery: {...state.gallery}
		};
		val.gallery.id = 0;

		return val;
	})
);
