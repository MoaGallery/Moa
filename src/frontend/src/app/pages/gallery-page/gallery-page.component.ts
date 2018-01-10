import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {PageDataService} from "../../services/page_data.service";

@Component({
	selector: 'gallery-page',
	templateUrl: './gallery-page.component.html',
	styleUrls: ['./gallery-page.component.css']
})
export class GalleryPageComponent implements OnInit {
	constructor(private route: ActivatedRoute,
	            private page_data_service: PageDataService) {
	}

	ngOnInit(): void {
		this.route.params.subscribe(params => {
			this.page_data_service.GetGalleryPageData(params['id']);
		});
	}
}