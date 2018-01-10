import {Injectable} from "@angular/core";
import {DataService} from "./data.service";
import {HttpClient} from "@angular/common/http";

@Injectable()
export class PageDataService {
	protected api_url: string = '/api/page_data/';

    constructor(private data_service: DataService, private http: HttpClient) {
    }

    GetPageData(url: string) {
	    this.http.get(url).subscribe(data => {
		    this.data_service.setPageData(data);
	    });
    }

    GetHomePageData() {
	    let url = this.api_url + 'home_page';
	    this.GetPageData(url);
    }

	GetGalleryPageData(id: number) {
		let url = this.api_url + 'gallery_page/' + id;
		this.GetPageData(url);
	}

	GetImagePageData(id: number) {
		let url = this.api_url + 'image_page/' + id;
		this.GetPageData(url);
	}
}