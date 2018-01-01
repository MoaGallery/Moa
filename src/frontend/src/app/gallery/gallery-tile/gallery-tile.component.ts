import { Component, Input } from '@angular/core';
import {Gallery} from "../../models/gallery.model";

@Component({
  selector: 'gallery-tile',
  templateUrl: './gallery-tile.component.html',
  styleUrls: ['./gallery-tile.component.css']
})
export class GalleryTileComponent {

    @Input() gallery: Gallery;

    constructor() { }
}
