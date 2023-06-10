import {createReducer, on} from '@ngrx/store';
import {otherDataLoadedAction} from './app.action';

export interface AppState {
	galleries: [],
	tags: []
}

const initialState = {
	galleries: [],
	tags: []
};

export const AppReducer = createReducer<{galleries: any[], tags: any[]}>(
	initialState,
	on(otherDataLoadedAction, (state: AppState, data) => {
		var val = {
			galleries: {...state.galleries},
			tags: {...state.tags}
		};
		val.galleries = {...data.galleries};
		val.tags = {...data.tags};
		return val;
	})
);
