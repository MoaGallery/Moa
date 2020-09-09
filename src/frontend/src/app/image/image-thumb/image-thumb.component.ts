import {Component, Input} from '@angular/core';
import {GalleryService} from '../../services/gallery_service';
import {Router} from '@angular/router';

@Component({
  selector: 'image-thumb',
  templateUrl: './image-thumb.component.html',
  styleUrls: ['./image-thumb.component.css']
})
export class ImageThumbComponent {

	@Input() image: any;
	@Input() gallery_id: any;

	showDropTargets: boolean;

	constructor(private galleryService: GalleryService,
	            private router: Router) { }

	getLink() {
		return '/image/' + this.gallery_id + '/' + this.image.id;
	}

	onDragEnter($event) {
		$event.preventDefault();
		$event.stopPropagation();
		if (localStorage.getItem('moaDragId') != this.image.id)
			this.showDropTargets = true;
	}

	onDragLeave($event) {
		$event.preventDefault();
		$event.stopPropagation();

		let element = $event.relatedTarget.closest('.inner-thumbnail');
		if (element !== null) {
			let image_id = element.getAttribute('data-image_id');
			if (image_id != this.image.id)
				this.showDropTargets = false;
		} else {
			this.showDropTargets = false;
		}
	}

	onDrag($event, image_id) {
		localStorage.setItem('moaDragType', 'image');
		localStorage.setItem('moaDragId', image_id);
	}

	onDrop($event) {
		let droppedId = localStorage.getItem('moaDragId');
		localStorage.removeItem('moaDragType');
		localStorage.removeItem('moaDragId');

		this.showDropTargets = false;

		let direction = $event.toElement.getAttribute('data-direction');

		if (direction !== null) {
			this.galleryService.MoveImage(this.gallery_id, droppedId, direction, this.image.id
			).subscribe(data => {
				this.router.navigate(['/gallery/' + this.gallery_id])
			});
		}

		$event.preventDefault();
		$event.stopPropagation();
	}

	onDragOver($event: DragEvent) {
		$event.preventDefault();
		$event.stopPropagation();
	}
}
