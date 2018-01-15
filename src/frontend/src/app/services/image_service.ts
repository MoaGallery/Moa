import {Injectable} from "@angular/core";
import {DataService} from "./data.service";
import {HttpClient} from "@angular/common/http";
import {Subject} from "rxjs/Subject";
import {Observable} from "rxjs/Observable";

@Injectable()
export class ImageService {

	protected api_url: string = '/api/image/';

	constructor(private dataService: DataService,
	            private http: HttpClient) {
	}

	SubmitImage(data): Observable<any> {
		let url = this.api_url + data.id;
		let subject = new Subject();

		let body = {
			id: data.id,
			gallery_id: data.gallery_id,
			description: data.description,
			tags: data.tags,
			fileHashes: data.fileHashes
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

	DeleteImage(id): Observable<any> {
		let url = this.api_url + id;
		let subject = new Subject();

		this.http.delete(url)
			.subscribe(data => {
				subject.next({success: data['success'], message: data['message']});
			});

		return subject.asObservable();
	}
}