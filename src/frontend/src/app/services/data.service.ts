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
}