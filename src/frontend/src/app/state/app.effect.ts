import {Injectable} from '@angular/core';
import {AppService} from '../app.service';
import {Actions, createEffect, ofType} from '@ngrx/effects';
import * as AppActions from './app.action';
import {map, mergeMap} from 'rxjs/operators';

@Injectable()
export class AppEffect {
	constructor(private actions$:Actions, private appService: AppService) {
	}

	loadOtherData$ = createEffect(() => {
		return this.actions$.pipe(
			ofType(AppActions.loadOtherDataAction),
			mergeMap(() => {
				return this.appService.getOtherData().pipe(
					map((data) => {
						return AppActions.otherDataLoadedAction({galleries: data.galleries, tags: data.tags})
					})
				)
			})
		)
	})
}
