import {Component, OnInit} from '@angular/core';
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
