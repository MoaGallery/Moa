import {Injectable} from "@angular/core";
import {DataService} from "./data.service";
import {HttpClient} from "@angular/common/http";
import {Subject} from "rxjs";
import {Observable} from "rxjs";
import {Gallery} from '../models/gallery.model';
import {Subscription} from 'rxjs/Subscription';
import {ParentGallery} from '../models/parent-gallery.model';

@Injectable()
export class GalleryService {
	get gallery(): Gallery {
		return this._gallery;
	}

	protected api_url: string = '/api/gallery/';
	private _gallery: Gallery;

	private galleryObserver: Subscription;

	constructor(private dataService: DataService,
	            private http: HttpClient) {
		this._gallery = new Gallery();
		this._gallery.tagList = [];
		this._gallery.parentGallery = new ParentGallery();
		this.galleryObserver = dataService.getGalleryObserver().subscribe(
			data => {
				this._gallery.fromData(data);
			}
		);
	}

	SubmitGallery(data): Observable<any> {
		let url = this.api_url + data.id;
		let subject = new Subject();

		let body = {
			name: data.name,
			description: data.description,
			parent: data.parent,
			tags: data.tags,
			useTags: data.useTags,
			showImages: data.showImages
		};

		if (data.id > 0) {
			this.http.put(url, body).subscribe(data => {
				subject.next({success: data['success'], message: data['message']});
				this.dataService.setPageData(data);
			});
		} else {
			this.http.post(url, body).subscribe(data => {
				subject.next({success: data['success'], message: data['message']});
				this.dataService.setPageData(data);
			});
		}

		return subject.asObservable();
	}

	DeleteGallery(id): Observable<any> {
		let url = this.api_url + id;
		let subject = new Subject();

		this.http.delete(url)
			.subscribe(data => {
				subject.next({success: data['success'], message: data['message']});
			});

		return subject.asObservable();
	}
}
