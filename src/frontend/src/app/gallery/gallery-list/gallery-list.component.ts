import {Component} from '@angular/core';
import {Store} from '@ngrx/store';
import {GalleryState} from '../state/gallery.reducer';
import {getGalleryId} from '../state/gallery.selector';
import {AppState} from '../../state/app.reducer';
import {SimpleGallery} from '../../models/simple_gallery';
import {getSubGalleries} from '../../state/app.selector';

@Component({
  selector: 'gallery-list',
  templateUrl: './gallery-list.component.html',
  styleUrls: ['./gallery-list.component.css']
})
export class GalleryListComponent {

	public galleryId: number = 0;
	public galleries: SimpleGallery[] = [];

    constructor(private galleryStore: Store<GalleryState>,
                private appStore: Store<AppState>) {
    }

	ngOnInit(): void {
		this.galleryStore.select(getGalleryId).subscribe(
			(id: number) => {
				this.galleryId = id;

				this.appStore.select(getSubGalleries({id: this.galleryId})).subscribe(
					(galleries: SimpleGallery[]) => {
						this.galleries = galleries;
					}
				);
			}
		);
	}
}
