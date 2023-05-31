import {createAction, props} from '@ngrx/store';
import {Gallery} from '../gallery.model';

export const loadGalleryAction = createAction('[Gallery] Load gallery', props<{id: number}>());

export const galleryLoadedAction = createAction('[Gallery] Gallery loaded', props<{gallery: Gallery}>());
