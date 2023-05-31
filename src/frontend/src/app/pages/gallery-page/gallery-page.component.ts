import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {Gallery} from '../../models/gallery';
import {Observable} from 'rxjs';
import {SimpleGallery} from '../../models/simple_gallery';
import {loadGalleryAction} from '../../gallery/state/gallery.action';
import {Store} from '@ngrx/store';
import {GalleryState} from '../../gallery/state/gallery.reducer';
import {State} from '../../state/app.state';
import {loadOtherDataAction} from '../../state/app.action';

@Component({
	selector: 'gallery-page',
	templateUrl: './gallery-page.component.html',
	styleUrls: ['./gallery-page.component.css']
})
export class GalleryPageComponent implements OnInit {

	public gallery$: Observable<Gallery>;
	public id: number = 0;

	constructor(private route: ActivatedRoute,
	            private galleryStore: Store<GalleryState>,
	            private rootStore: Store<State>) {
	}

	ngOnInit(): void {
		this.route.params.subscribe(params => {
			this.id = params.gallery_id;
			this.galleryStore.dispatch(loadGalleryAction({id: this.id}));
			this.rootStore.dispatch(loadOtherDataAction());
		});
	}
}
