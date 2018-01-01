import {Component} from '@angular/core';
import {Gallery} from "../../models/gallery.model";
import {PageService} from "../../services/page.service";

@Component({
  selector: 'gallery-list',
  templateUrl: './gallery-list.component.html',
  styleUrls: ['./gallery-list.component.css']
})
export class GalleryListComponent {

    galleries: Gallery[];

    constructor(private service: PageService) {
        this.galleries = service.pageData['galleries'];
    }
}
