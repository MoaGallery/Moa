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

	static readonly TARGET_HEIGHT: Number = 300;
	static readonly GALLERY_WIDTH: Number = 1140;

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
		let imageWidths = [];
		let totalWidth = 0;

		if (this.thumbSub !== undefined)
			this.thumbSub.unsubscribe();

		let toGenerate = [];
		if (this.images !== undefined) {
			for (let image of this.images) {
				if (image.isGenerating) {
					toGenerate.push(parseInt(image.id));
				}

				let width = image.width * (Number(ImageListComponent.TARGET_HEIGHT) / image.height);
				imageWidths.push(width);
				totalWidth += width;
			}

			if (toGenerate.length > 0)
				this.getThumbs(toGenerate);

			let maxWidth = Number(ImageListComponent.GALLERY_WIDTH) * 1.2;

			let rows = [];
			let row = {
				width: 0,
				images: 0
			};
			let i = 0;
			while (i < imageWidths.length) {
				row.width += imageWidths[i];
				row.images++;
				if ((row.width > ImageListComponent.GALLERY_WIDTH) &&
					(row.images > 1)) {
					if (row.width > maxWidth) {
						row.width -= imageWidths[i];
						row.images--;
						rows.push(row);
						row = {
							width: imageWidths[i],
							images: 1
						};
					} else {
						rows.push(row);
						row = {
							width: 0,
							images: 0
						};
					}
				}
				i++;
			}
			if ((row.images === 1) &&
				(rows.length > 0)){
				rows[rows.length-1].images++;
				rows[rows.length-1].width += row.width;
				row = {
					width: 0,
					images: 0
				}
			}
			if ((row.images > 1) ||
				(rows.length === 0)) {
				rows.push(row);
			}

			i = 0;
			for (let row of rows) {
				let scaleFactor = Number(ImageListComponent.GALLERY_WIDTH) / row.width;
				for (let j = 0; j < row.images; j++) {
					this.images[i].displayWidth = Math.floor(imageWidths[i] * scaleFactor);
					this.images[i].displayHeight = Math.floor   (Number(ImageListComponent.TARGET_HEIGHT) * scaleFactor);
					i++;
				}
			}
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
