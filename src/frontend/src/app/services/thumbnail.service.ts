import { Injectable } from '@angular/core';
import {Subject} from "rxjs";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";

@Injectable()
export class ThumbnailService {

	private api_url: string = '/api/thumbnail_status';

	constructor(private http: HttpClient) {}

	public getStatus(data: Array<number> = null): Observable<any> {
		let subject = new Subject();

		let params = data.join(',');
		let url = this.api_url + '?images=' + params;

		this.http.get(url).subscribe(data => {
			subject.next(data);
		});

		return subject.asObservable();
	}
}
