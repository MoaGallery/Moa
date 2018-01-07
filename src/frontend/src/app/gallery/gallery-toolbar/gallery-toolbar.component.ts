import {Component, OnDestroy} from '@angular/core';
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";
import {ButtonClickService} from "../../services/button-click.service";

@Component({
  selector: 'gallery-toolbar',
  templateUrl: './gallery-toolbar.component.html',
  styleUrls: ['./gallery-toolbar.component.css']
})
export class GalleryToolbarComponent implements OnDestroy {

	gallery = {
		name: '',
		description: ''
	};

	observer: Subscription;
	constructor(private dataService: DataService, private buttonClickService: ButtonClickService) {
		this.observer = dataService.getGalleryObserver().subscribe(
			data => {
				this.gallery = data;
			}
		);
	}

	onEditClick() {
		this.buttonClickService.trigger('galleryEditClick');
	}

	ngOnDestroy() {
		this.observer.unsubscribe();
	}
}
