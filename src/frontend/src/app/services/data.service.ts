import {Injectable} from "@angular/core";
import {HttpClient} from "@angular/common/http";
import {BehaviorSubject} from "rxjs/BehaviorSubject";
import {Observable} from "rxjs/Observable";
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/filter';

@Injectable()
export class DataService {
    data: BehaviorSubject<any>;

    constructor(private http: HttpClient) {
        this.data = new BehaviorSubject<any>([]);
    }

    setPageData(pageData): void {
        this.data.next(pageData);
    }

    getBreadcrumbObserver(): Observable<any> {
        return this.data
            .map(data => {
                return data.breadcrumbs;
            })
            .filter(data => data !== undefined);
    }

    getGalleriesObserver(): Observable<any> {
        return this.data
            .map(data => {
                return data.galleries;
            })
            .filter(data => data !== undefined);
    }

	getGalleryObserver(): Observable<any> {
		return this.data
			.map(data => {
				// TODO: Convert to Gallery model?
				return data.gallery;
			})
			.filter(data => data !== undefined);
	}

	getImageObserver(): Observable<any> {
		return this.data
			.map(data => {
				// TODO: Convert to Image model?
				return data.image;
			})
			.filter(data => data !== undefined);
	}

	getImagesObserver(): Observable<any> {
		return this.data
			.map(data => {
				return data.images;
			})
			.filter(data => data !== undefined);
	}

	getPageTitleObserver(): Observable<any> {
		return this.data
			.map(data => {
				return data.page_title;
			})
			.filter(data => data !== undefined);
	}

}