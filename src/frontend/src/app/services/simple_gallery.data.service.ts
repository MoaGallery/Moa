import {Injectable} from '@angular/core';
import {DefaultDataService, HttpUrlGenerator} from '@ngrx/data';
import {SimpleGallery} from '../models/simple_gallery';
import {HttpClient} from '@angular/common/http';

@Injectable()
export class SimpleGalleryDataService extends DefaultDataService<SimpleGallery> {
	constructor(http: HttpClient, httpUrlGenerator: HttpUrlGenerator) {
		super('SimpleGallery', http, httpUrlGenerator);
	}
}
