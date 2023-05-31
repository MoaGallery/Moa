import {createAction, props} from '@ngrx/store';

export const loadOtherDataAction = createAction('[Root] Load other data');

export const otherDataLoadedAction = createAction('[Root] Other data loaded', props<{galleries: [], tags: []}>());
