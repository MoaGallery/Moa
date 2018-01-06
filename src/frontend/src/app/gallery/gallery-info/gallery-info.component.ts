import {Component, OnDestroy} from '@angular/core';
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";

@Component({
  selector: 'gallery-info',
  templateUrl: './gallery-info.component.html',
  styleUrls: ['./gallery-info.component.css']
})
export class GalleryInfoComponent implements OnDestroy {

	gallery: Array<any>;
	observer: Subscription;

	constructor(private service: DataService) {
	  this.observer = service.getGalleryObserver().subscribe(
		  data => {
			  this.gallery = data;
		  }
	  );
	}

	ngOnDestroy(): void {
		this.observer.unsubscribe();
	}

}
