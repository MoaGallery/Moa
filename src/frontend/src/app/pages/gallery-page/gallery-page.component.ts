import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {PageDataService} from "../../services/page_data.service";
import {Gallery} from '../../models/gallery';
import {GalleryService} from '../../services/gallery_service';
import {GalleryEntityService} from '../../services/gallery-entity.service';
import {Observable} from 'rxjs';
import { map } from 'rxjs/operators';
import { tap } from 'rxjs/operators';
import {SimpleGallery} from '../../models/simple_gallery';
import {SimpleGalleryEntityService} from '../../services/simple_gallery-entity.service';

@Component({
	selector: 'gallery-page',
	templateUrl: './gallery-page.component.html',
	styleUrls: ['./gallery-page.component.css']
})
export class GalleryPageComponent implements OnInit {

	public gallery$: Observable<Gallery>;
	public simpleGalleries$: Observable<SimpleGallery[]>;
	public id: number = 32;

	constructor(private route: ActivatedRoute,
	            private galleryEntityService: GalleryEntityService,
	            private simpleGalleryEntityService: SimpleGalleryEntityService) {
		console.log(this.route);
	}

	ngOnInit(): void {
		this.gallery$ = this.galleryEntityService.entities$
			.pipe(
				tap(galleries => {console.log(galleries)}),
				map(galleries => galleries.find(gallery => gallery.id == this.id))
			);
		this.simpleGalleries$ = this.simpleGalleryEntityService.entities$
			.pipe(
				tap(simpleGalleries => {console.log(simpleGalleries)}),
				map(galleries => galleries.filter(gallery => gallery.parentId == this.id))
			);
		this.simpleGalleryEntityService.getAll();

		this.route.params.subscribe(params => {
			this.galleryEntityService.getByKey(this.id);
		});
	}
}
