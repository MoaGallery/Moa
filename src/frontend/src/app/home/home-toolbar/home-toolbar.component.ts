import {Component, OnDestroy} from '@angular/core';
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";
import {ButtonClickService} from "../../services/button-click.service";
import {Router} from "@angular/router";

declare var $: any;

@Component({
  selector: 'home-toolbar',
  templateUrl: './home-toolbar.component.html',
  styleUrls: ['./home-toolbar.component.css']
})
export class HomeToolbarComponent implements OnDestroy {

	gallery = {
		id: 0,
		parent_id: 0,
		name: '',
		description: '',
		tag_list: [],
		parent_gallery: {
			id: 0,
			name: 'Homepage'
		}
	};
	observer: Subscription;

	constructor(private dataService: DataService,
	            private buttonClickService: ButtonClickService,
	            private router: Router) {
		this.observer = dataService.getGalleryObserver().subscribe(
			data => {
				this.gallery = data;
			}
		);
	}

	onAddGalleryClick() {
		this.buttonClickService.trigger('galleryAddClick');
	}

	ngOnDestroy() {
		this.observer.unsubscribe();
	}
}
