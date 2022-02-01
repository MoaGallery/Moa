import {Component} from '@angular/core';
import {GalleryEntityService} from '../../services/gallery-entity.service';
import {Observable} from 'rxjs';
import {Gallery} from '../../models/gallery';
import {map} from 'rxjs/operators';

@Component({
  selector: 'gallery-info',
  templateUrl: './gallery-info.component.html',
  styleUrls: ['./gallery-info.component.css']
})
export class GalleryInfoComponent {

	public gallery$: Observable<Gallery>
	constructor(private galleryService: GalleryEntityService) {
	}

	private ngOnInit() {
		this.gallery$ = this.galleryService.entities$
			.pipe(
				map(gallery => gallery.find(gallery => gallery.id == 32))
			);
	}
}
