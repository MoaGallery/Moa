import {Component, Input} from '@angular/core';
import {GalleryService} from "../gallery.service";
import {Router} from "@angular/router";
import {Gallery} from '../../models/gallery';
import {map, tap} from 'rxjs/operators';
import {Observable} from 'rxjs';

declare var $: any;

@Component({
  selector: 'gallery-toolbar',
  templateUrl: './gallery-toolbar.component.html',
  styleUrls: ['./gallery-toolbar.component.css']
})
export class GalleryToolbarComponent {

	@Input() gallery: Gallery;

	constructor(private router: Router) {
	}

	private ngOnInit() {
	}

	onEditClick() {
		//this.buttonClickService.trigger('galleryEditClick');
	}

	onAddGalleryClick() {
		//this.buttonClickService.trigger('galleryAddClick');
	}

	onAddImageClick() {
		//this.buttonClickService.trigger('imageAddClick');
	}

	onDeleteClick() {
		if (confirm('Delete this gallery?')) {
			/*this.galleryService.delete(this.gallery)
				.pipe(
					tap(gallery => {
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
					})
				);*/
		}
	}
}
