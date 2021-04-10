import {Injectable, OnDestroy} from "@angular/core";
import {Subscription} from "rxjs";
import {DataService} from "./data.service";

@Injectable()
export class PageTitleService implements OnDestroy{

	observer: Subscription;

    constructor(private service: DataService) {
	    this.observer = service.getPageTitleObserver().subscribe(
		    data => {
				document.title = data;
		    }
	    );
    }

	ngOnDestroy(): void {
		this.observer.unsubscribe();
	}
}
