import {Injectable} from "@angular/core";
import {DataService} from "./data.service";
import {HttpClient} from "@angular/common/http";
import {Subject} from "rxjs/Subject";
import {Observable} from "rxjs/Observable";

@Injectable()
export class GalleryService {

	protected api_url: string = '/api/gallery/';

	constructor(private dataService: DataService,
	            private http: HttpClient) {
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

	DeleteGallery(id, parent_id): Observable<any> {
		let url = this.api_url + id;
		let subject = new Subject();

		this.http.delete(url)
			.subscribe(data => {
				subject.next({success: data['success'], message: data['message']});
			});

		return subject.asObservable();
	}

	MoveImage(gallery_id, image_id, position, targetImageId): Observable<any> {
		let url = this.api_url + gallery_id + '/' + image_id + '/move/' + position + '/' + targetImageId;
		let subject = new Subject();

		this.http.post(url, null)
			.subscribe(data => {
				subject.next({success: data['success'], message: data['message']});
			});

		return subject.asObservable();
	}
}
