import {Injectable} from "@angular/core";
import {HttpClient} from "@angular/common/http";

@Injectable()
export class ImageService {

	protected api_url: string = '/api/image/';

	constructor(private http: HttpClient) {
	}
}
