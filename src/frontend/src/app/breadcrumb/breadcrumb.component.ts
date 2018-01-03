import {Component, OnDestroy} from '@angular/core';
import {Breadcrumb} from "../models/breadcrumb.model";
import {DataService} from "../services/data.service";
import {Subscription} from "rxjs/Subscription";

@Component({
  selector: 'breadcrumb',
  templateUrl: './breadcrumb.component.html',
  styleUrls: ['./breadcrumb.component.css']
})
export class BreadcrumbComponent implements OnDestroy {
    crumbs: Breadcrumb[];
    observer: Subscription;

    constructor(private service: DataService){
        this.observer = service.getBreadcrumbObserver().subscribe(
            data => {
                if (data !== undefined)
                    this.crumbs = data;
            }
        );
    }

    ngOnDestroy(): void {
        this.observer.unsubscribe();
    }
}
