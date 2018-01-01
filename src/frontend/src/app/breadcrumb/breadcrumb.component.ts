import {Component} from '@angular/core';
import {Breadcrumb} from "../models/breadcrumb.model";
import {PageService} from "../services/page.service";

@Component({
  selector: 'breadcrumb',
  templateUrl: './breadcrumb.component.html',
  styleUrls: ['./breadcrumb.component.css']
})
export class BreadcrumbComponent {

    crumbs: Breadcrumb[];

    constructor(private service: PageService){
        this.crumbs = service.pageData['breadcrumbs'];
    }
}
