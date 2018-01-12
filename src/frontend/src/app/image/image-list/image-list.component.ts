import {Component, Input, OnDestroy} from '@angular/core';
import {Subscription} from "rxjs/Subscription";
import {DataService} from "../../services/data.service";

@Component({
  selector: 'image-list',
  templateUrl: './image-list.component.html',
  styleUrls: ['./image-list.component.css']
})
export class ImageListComponent implements OnDestroy {

	images: Array<any>;
	gallery: Array<any>;
	imagesObserver: Subscription;
	galleryObserver: Subscription;

	constructor(private service: DataService) {
		this.imagesObserver = service.getImagesObserver().subscribe(
			data => {
				this.images = data;
			}
		);

		this.galleryObserver = service.getGalleryObserver().subscribe(
			data => {
				this.gallery = data;
			}
		);
	}

	ngOnDestroy() {
		this.imagesObserver.unsubscribe();
		this.galleryObserver.unsubscribe();
	}
}
