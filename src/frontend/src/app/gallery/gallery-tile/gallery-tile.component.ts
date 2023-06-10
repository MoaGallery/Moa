import { Component, Input } from '@angular/core';
import {SimpleGallery} from '../../models/simple_gallery';

@Component({
  selector: 'gallery-tile',
  templateUrl: './gallery-tile.component.html',
  styleUrls: ['./gallery-tile.component.css']
})
export class GalleryTileComponent {

    @Input() gallery: SimpleGallery;

    constructor() { }
    getLink(id) {
        return '/gallery/' + this.gallery.id;
    }

	doesThumbExist(thumbId: number) {
    	return thumbId !== null;
	}
}
