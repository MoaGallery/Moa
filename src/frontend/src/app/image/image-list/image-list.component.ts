import {Component, OnDestroy} from '@angular/core';
import {Subscription} from "rxjs/Subscription";
import {DataService} from "../../services/data.service";

@Component({
  selector: 'image-list',
  templateUrl: './image-list.component.html',
  styleUrls: ['./image-list.component.css']
})
export class ImageListComponent implements OnDestroy {

	images: Array<any>;
	observer: Subscription;

	constructor(private service: DataService) {
		this.observer = service.getImagesObserver().subscribe(
			data => {
				this.images = data;
			}
		);
	}

	ngOnDestroy() {
		this.observer.unsubscribe();
	}
}
