import { Component, Input } from '@angular/core';
import {Gallery} from "../gallery.model";

@Component({
  selector: 'gallery-tile',
  templateUrl: './gallery-tile.component.html',
  styleUrls: ['./gallery-tile.component.css']
})
export class GalleryTileComponent {

    @Input() gallery: Gallery;

    constructor() { }
    getLink(id) {
        return '/gallery/' + this.gallery.id;
    }

	doesThumbExist(thumbId: number) {
    	return thumbId !== null;
	}
}
