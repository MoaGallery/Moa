import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {Store} from '@ngrx/store';
import {GalleryState} from '../../gallery/state/gallery.reducer';
import {State} from '../../state/app.state';
import {loadOtherDataAction} from '../../state/app.action';
import {setHomePageAction} from '../../gallery/state/gallery.action';

@Component({
    selector: 'moa',
    templateUrl: './home-page.component.html',
    styleUrls: ['./home-page.component.css']
})
export class HomePageComponent implements OnInit {
	constructor(private route: ActivatedRoute,
	            private galleryStore: Store<GalleryState>,
	            private rootStore: Store<State>) {
	}

	ngOnInit(): void {
		this.route.params.subscribe(params => {
			this.galleryStore.dispatch(setHomePageAction());
			this.rootStore.dispatch(loadOtherDataAction());
		});
	}
}
