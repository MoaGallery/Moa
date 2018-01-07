import {Injectable} from "@angular/core";
import {DataService} from "./data.service";
import {HttpClient} from "@angular/common/http";
import {Subject} from "rxjs/Subject";
import {Observable} from "rxjs/Observable";

@Injectable()
export class GalleryService {

	protected api_url: string = '/api/gallery/';

	constructor(private dataService: DataService, private http: HttpClient) {
	}

	EditGallery(data): Observable<any> {
		let url = this.api_url + data.id;
		let subject = new Subject();

		this.http.put(url, {
			name: data.name,
			description: data.description,
			parent: data.parent,
			tags: data.tags,
			useTags: data.useTags,
			showImages: data.showImages
		}).subscribe(data => {
			subject.next({success: data['success'], message: data['message']});
			this.dataService.setPageData(data);
		});

		return subject.asObservable();
	}
}