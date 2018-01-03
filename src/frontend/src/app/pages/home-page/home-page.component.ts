import {Component, ElementRef, OnInit} from '@angular/core';
import {DataService} from "../../services/data.service";
import {PageDataService} from "../../services/page_data.service";

@Component({
    selector: 'moa',
    templateUrl: './home-page.component.html',
    styleUrls: ['./home-page.component.css']
})
export class HomePageComponent implements OnInit {
    constructor(private page_data_service: PageDataService) {
    }

    ngOnInit(): void {
    	this.page_data_service.GetHomePageData();
    }
}
