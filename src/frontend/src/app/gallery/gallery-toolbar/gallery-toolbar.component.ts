import {Component, OnDestroy} from '@angular/core';
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";
import {ButtonClickService} from "../../services/button-click.service";
import {GalleryService} from "../../services/gallery_service";
import {Router} from "@angular/router";

declare var $: any;

@Component({
  selector: 'gallery-toolbar',
  templateUrl: './gallery-toolbar.component.html',
  styleUrls: ['./gallery-toolbar.component.css']
})
export class GalleryToolbarComponent implements OnDestroy {

	gallery = {
		id: 0,
		parent_id: 0,
		name: '',
		description: ''
	};
	observer: Subscription;

	constructor(private dataService: DataService,
	            private buttonClickService: ButtonClickService,
	            private galleryService: GalleryService,
	            private router: Router) {
		this.observer = dataService.getGalleryObserver().subscribe(
			data => {
				this.gallery = data;
			}
		);
	}

	onEditClick() {
		this.buttonClickService.trigger('galleryEditClick');
	}

	onAddGalleryClick() {
		this.buttonClickService.trigger('galleryAddClick');
	}

	onAddImageClick() {
		this.buttonClickService.trigger('imageAddClick');
	}

	onDeleteClick() {
		if (confirm('Delete this gallery?')) {
			this.galleryService.DeleteGallery(this.gallery.id, this.gallery.parent_id).subscribe(next => {
				let options =
					{
						message: 'Gallery deleted',
						container: '#editSuccessContainer',
						duration: 5000
					};
				$.meow(options);

				if (this.gallery.parent_id > 0)
					this.router.navigate(['/gallery/' + this.gallery.parent_id]);
				else
					this.router.navigate(['/']);

			});
		}
	}

	ngOnDestroy() {
		this.observer.unsubscribe();
	}
}
