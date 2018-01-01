import {Component, ElementRef} from '@angular/core';
import {Breadcrumb} from "./models/breadcrumb.model";
import {Gallery} from "./models/gallery.model";
import {PageService} from "./services/page.service";

@Component({
  selector: 'moa',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
    preload = {};

    constructor(private service: PageService, private elementRef:ElementRef) {
        service.setPageData(JSON.parse(this.elementRef.nativeElement.getAttribute('[preload]')));
    }
}
