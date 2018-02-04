import { Component, OnDestroy } from '@angular/core';
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";
import {NgBoxService} from "../../ngbox/ngbox.service";

@Component({
  selector: 'image-info',
  templateUrl: './image-info.component.html',
  styleUrls: ['./image-info.component.css']
})
export class ImageInfoComponent implements OnDestroy {

	image = {
		id: 0,
		image_src: '',
		description: '',
		format: 'jpg'
	};
	observer: Subscription;
	imageFullUrl: string;

	constructor(private service: DataService) {
		this.imageFullUrl = this.getFullImageUrl();
		this.observer = service.getImageObserver().subscribe(
			data => {
				this.image = data;
				this.imageFullUrl = this.getFullImageUrl();
			}
		);
	}

	ngOnDestroy() {
		this.observer.unsubscribe();
	}

	getFullImageUrl() {
		return '/image/' + this.image.id + '.' + this.image.format;
	}
}
