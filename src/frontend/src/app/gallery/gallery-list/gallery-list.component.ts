import {Component} from '@angular/core';
import {Gallery} from "../../models/gallery.model";
import {DataService} from "../../services/data.service";
import {Subscription} from "rxjs/Subscription";

@Component({
  selector: 'gallery-list',
  templateUrl: './gallery-list.component.html',
  styleUrls: ['./gallery-list.component.css']
})
export class GalleryListComponent {

    galleries: Gallery[];
    observer: Subscription;

    constructor(private service: DataService) {
        this.observer = service.getGalleriesObserver().subscribe(
            data => {
                this.galleries = data;
            }
        );
    }

    ngOnDestroy(): void {
        this.observer.unsubscribe();
    }
}
