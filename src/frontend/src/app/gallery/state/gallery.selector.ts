import {createFeatureSelector, createSelector} from '@ngrx/store';
import {GalleryState} from './gallery.reducer';

const getGalleryFeatureSelector = createFeatureSelector<GalleryState>('gallery');

export interface GalleryInfoData {
	name: string,
	description: string
}
const EmptyGalleryInfo = {
	name: '',
	description: ''
};
export const getGalleryInfo = createSelector(
	getGalleryFeatureSelector,
	(state) => {
		let data: GalleryInfoData = EmptyGalleryInfo;
		data.name = state.gallery.name;
		data.description = state.gallery.description;
		return data;
	}
);

export const getGalleryId = createSelector(
	getGalleryFeatureSelector,
	(state) => {
		return state.gallery.id;
	}
);
