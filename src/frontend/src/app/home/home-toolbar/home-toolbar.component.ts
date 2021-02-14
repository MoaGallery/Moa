import {Component, OnDestroy} from '@angular/core';
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";
import {ButtonClickService} from "../../services/button-click.service";
import {GalleryService} from "../../services/gallery_service";
import {Router} from "@angular/router";
import {IdentityService} from '../../services/identity.service';

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
	rights = {
		isAdmin: false
	};
	observer: Subscription;

	constructor(private dataService: DataService,
	            private buttonClickService: ButtonClickService,
	            private galleryService: GalleryService,
	            private identityService: IdentityService,
	            private router: Router) {
		this.observer = dataService.getGalleryObserver().subscribe(
			data => {
				this.gallery = data;
			}
		);
		this.rights.isAdmin = identityService.isAdmin();
	}

	onAddGalleryClick() {
		this.buttonClickService.trigger('galleryAddClick');
	}

	ngOnDestroy() {
		this.observer.unsubscribe();
	}
}
