import {Injectable} from '@angular/core';
import {DefaultDataService, HttpUrlGenerator} from '@ngrx/data';
import {Gallery} from '../models/gallery';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';

@Injectable()
export class GalleryDataService extends DefaultDataService<Gallery> {
	constructor(http: HttpClient, httpUrlGenerator: HttpUrlGenerator) {
		super('Gallery', http, httpUrlGenerator);
	}

	/*public getById(key: number | string): Observable<any> {
		return this.http.get('/api/page_data/gallery_page/' + key);
	}*/
}
