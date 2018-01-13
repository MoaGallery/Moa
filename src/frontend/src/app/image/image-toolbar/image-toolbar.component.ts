import { Component, OnDestroy } from '@angular/core';
import {ButtonClickService} from "../../services/button-click.service";
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";

@Component({
  selector: 'image-toolbar',
  templateUrl: './image-toolbar.component.html',
  styleUrls: ['./image-toolbar.component.css']
})
export class ImageToolbarComponent implements OnDestroy {

	image = {
		id: 0,
		name: '',
		description: ''
	};
	observer: Subscription;

	constructor(private dataService: DataService,
	          private buttonClickService: ButtonClickService) {
		this.observer = dataService.getImageObserver().subscribe(
			data => {
				this.image = data;
			}
		);
	}

	onEditClick() {
		this.buttonClickService.trigger('imageEditClick');
	}

	onDeleteClick() {
		this.buttonClickService.trigger('imageDeleteClick');
	}

	ngOnDestroy() {
		this.observer.unsubscribe();
	}
}
