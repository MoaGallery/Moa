import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {PageDataService} from "../../services/page_data.service";
import {Gallery} from '../../models/gallery.model';
import {GalleryService} from '../../services/gallery_service';

@Component({
	selector: 'gallery-page',
	templateUrl: './gallery-page.component.html',
	styleUrls: ['./gallery-page.component.css']
})
export class GalleryPageComponent implements OnInit {

	public gallery: Gallery;

	constructor(private route: ActivatedRoute,
	            private page_data_service: PageDataService,
	            private galleryService: GalleryService) {
		this.gallery = this.galleryService.gallery;
	}

	ngOnInit(): void {
		this.route.params.subscribe(params => {
			this.page_data_service.GetGalleryPageData(params['id']);
		});
	}
}
