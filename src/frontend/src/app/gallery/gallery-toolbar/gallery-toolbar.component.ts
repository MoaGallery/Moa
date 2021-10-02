import {Component, Input} from '@angular/core';
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";
import {ButtonClickService} from "../../services/button-click.service";
import {GalleryService} from "../../services/gallery_service";
import {Router} from "@angular/router";
import {Gallery} from '../../models/gallery.model';

declare var $: any;

@Component({
  selector: 'gallery-toolbar',
  templateUrl: './gallery-toolbar.component.html',
  styleUrls: ['./gallery-toolbar.component.css']
})
export class GalleryToolbarComponent {

	@Input() gallery: Gallery;

	constructor(private dataService: DataService,
	            private buttonClickService: ButtonClickService,
	            private galleryService: GalleryService,
	            private router: Router) {
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
			this.galleryService.DeleteGallery(this.gallery.id, this.gallery.parentId).subscribe(next => {
				let options =
					{
						message: 'Gallery deleted',
						container: '#editSuccessContainer',
						duration: 5000
					};
				$.meow(options);

				if (this.gallery.parentId > 0)
					this.router.navigate(['/gallery/' + this.gallery.parentId]);
				else
					this.router.navigate(['/']);

			});
		}
	}
}
