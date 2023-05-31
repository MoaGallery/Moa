import {Component} from '@angular/core';
import {Store} from '@ngrx/store';
import {GalleryInfoData, getGalleryInfo} from '../state/gallery.selector';
import {GalleryState} from '../state/gallery.reducer';

@Component({
  selector: 'gallery-info',
  templateUrl: './gallery-info.component.html',
  styleUrls: ['./gallery-info.component.css']
})
export class GalleryInfoComponent {

	public galleryData;

	constructor(private store: Store<GalleryState>) {
	}

	private ngOnInit() {
		this.store.select(getGalleryInfo).subscribe(
			(data: GalleryInfoData) => {
				this.galleryData = data;
			}
		);
	}
}
