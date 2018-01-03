import {Component, ElementRef, OnInit} from '@angular/core';
import {DataService} from "./services/data.service";

@Component({
  selector: 'moa',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
    preload = {};
    data = [];

    constructor(private service: DataService, private elementRef:ElementRef) {
        this.preload = JSON.parse(this.elementRef.nativeElement.getAttribute('[preload]'));
    }

    ngOnInit(): void {
        this.service.setPageData(this.preload);
    }

    onClick() {
        this.service.setPageData(
        {
            breadcrumbs:
            [
                {
                    name: 'Gallery 2',
                    id: 12,
                    type: 'gallery'
                },
                {
                    name: 'Image B',
                    id: 123,
                    type: 'image'
                }
            ]
        });
    }
}
