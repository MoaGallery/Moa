import {Component, OnDestroy} from '@angular/core';
import {Breadcrumb} from "../models/breadcrumb.model";
import {DataService} from "../services/data.service";
import {Subscription} from "rxjs/Subscription";
import {forEach} from "@angular/router/src/utils/collection";

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
                this.crumbs = data;
            }
        );
    }

    ngOnDestroy(): void {
        this.observer.unsubscribe();
    }

    getLink(id) {
        for (let i = 0; i < this.crumbs.length; i++) {
            if (this.crumbs[i].id == id) {
                return '/' + this.crumbs[i].type + '/' + this.crumbs[i].id;
            }
        }

        return '/';
    }
}
