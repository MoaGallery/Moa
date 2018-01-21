import { Component, OnDestroy } from '@angular/core';
import {ButtonClickService} from "../../services/button-click.service";
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";
import {Router} from "@angular/router";
import {ImageService} from "../../services/image_service";

declare var $: any;

@Component({
  selector: 'image-toolbar',
  templateUrl: './image-toolbar.component.html',
  styleUrls: ['./image-toolbar.component.css']
})
export class ImageToolbarComponent implements OnDestroy {

	image = {
		id: 0,
		name: '',
		description: '',
		gallery_id: 0
	};
	observer: Subscription;

	constructor(private dataService: DataService,
				private buttonClickService: ButtonClickService,
				private imageService: ImageService,
	            private router: Router) {
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
		if (confirm('Delete this image?')) {
			this.imageService.DeleteImage(this.image.id).subscribe(next => {
				let options =
					{
						message: 'Image deleted',
						container: '#editSuccessContainer',
						duration: 5000
					};
				$.meow(options);

				this.router.navigate(['/gallery/' + this.image.gallery_id]);
			});
		}
	}

	ngOnDestroy() {
		this.observer.unsubscribe();
	}
}
