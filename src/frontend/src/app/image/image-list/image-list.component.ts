import {Component, OnInit, OnDestroy} from '@angular/core';
import {Subscription} from "rxjs/Subscription";
import {DataService} from "../../services/data.service";
import {forEach} from "@angular/router/src/utils/collection";
import {ThumbnailService} from "../../services/thumbnail.service";
import {Observable} from "rxjs/Observable";

@Component({
  selector: 'image-list',
  templateUrl: './image-list.component.html',
  styleUrls: ['./image-list.component.css']
})
export class ImageListComponent implements OnInit, OnDestroy {

	images: Array<any>;
	gallery: Array<any>;
	imagesObserver: Subscription;
	galleryObserver: Subscription;
	thumbSub: Subscription;

	constructor(private service: DataService,
	            private thumbService: ThumbnailService) {
		this.imagesObserver = service.getImagesObserver().subscribe(
			data => {
				this.images = data;
				this.checkThumbs();
			}
		);

		this.galleryObserver = service.getGalleryObserver().subscribe(
			data => {
				this.gallery = data;
			}
		);
	}

	ngOnInit() {
		this.checkThumbs();
	}

	private checkThumbs() {
		if (this.thumbSub !== undefined)
			this.thumbSub.unsubscribe();

		let toGenerate = [];
		if (this.images !== undefined) {
			for (let image of this.images) {
				if (image.isGenerating) {
					toGenerate.push(parseInt(image.id));
				}
			}

			if (toGenerate.length > 0)
				this.getThumbs(toGenerate);
		}
	}

	private getThumbs(toGenerate: Array<number>) {
		this.thumbSub = this.thumbService.getStatus(toGenerate).subscribe(data => {
			let nextBatch = [];
			for (let image of toGenerate) {
				let found: boolean = false;
				for (let notDoneYet of data) {
					if (image == notDoneYet)
						found = true;
				}

				if (!found) {
					for (let i of this.images) {
						if (image == i.id)
							i.isGenerating = false;
					}
				} else
				{
					nextBatch.push(image);
				}
			}

			this.thumbSub.unsubscribe();

			if (nextBatch.length > 0) {
				setTimeout(() => {
					this.getThumbs(nextBatch);
				}, 200);
			}
		});
	}

	ngOnDestroy() {
		this.imagesObserver.unsubscribe();
		this.galleryObserver.unsubscribe();
	}
}
