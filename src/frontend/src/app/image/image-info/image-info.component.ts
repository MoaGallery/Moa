import { Component, OnDestroy } from '@angular/core';
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";

@Component({
  selector: 'image-info',
  templateUrl: './image-info.component.html',
  styleUrls: ['./image-info.component.css']
})
export class ImageInfoComponent implements OnDestroy {

	image = {};
	observer: Subscription;

	constructor(private service: DataService) {
	  this.observer = service.getImageObserver().subscribe(
		  data => {
			  this.image = data;
		  }
	  );
	}

	ngOnDestroy() {
		this.observer.unsubscribe();
	}
}
