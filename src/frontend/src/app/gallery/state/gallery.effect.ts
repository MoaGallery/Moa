import {Injectable} from '@angular/core';
import {GalleryService} from '../gallery.service';
import {Actions, createEffect, ofType} from '@ngrx/effects';
import * as GalleryActions from './gallery.action';
import {map, mergeMap} from 'rxjs/operators';

@Injectable()
export class GalleryEffect {
	constructor(private actions$:Actions, private galleryService: GalleryService) {
	}

	loadGalleryInfo$ = createEffect(() => {
		return this.actions$.pipe(
			ofType(GalleryActions.loadGalleryAction),
			mergeMap((data: {id: number}) => {
				return this.galleryService.getGallery(data.id).pipe(
					map(gallery => {
						return GalleryActions.galleryLoadedAction({gallery: gallery})
					})
				)
			})
		)
	})
}
