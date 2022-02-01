import {ActivatedRouteSnapshot, Resolve, RouterStateSnapshot} from '@angular/router';
import {Injectable} from '@angular/core';
import {Observable} from 'rxjs';
import {filter, first, tap} from 'rxjs/operators';
import {GalleryEntityService} from './services/gallery-entity.service';

@Injectable()
export class GalleryResolver implements Resolve<boolean> {

	constructor(private galleryService: GalleryEntityService) {
	}

	resolve(route: ActivatedRouteSnapshot,
	        state: RouterStateSnapshot): Observable<boolean> {

		return this.galleryService.loaded$
			.pipe(
				tap(loaded => {
					if (!loaded) {
						//console.log(route, state)
						//this.galleryService.getAll()//ByKey(route.params.id);
					}
				}),
				filter(loaded => !!loaded),
				first()
			);
	}
}
