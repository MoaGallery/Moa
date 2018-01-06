import {Component, Input} from '@angular/core';

@Component({
  selector: 'image-thumb',
  templateUrl: './image-thumb.component.html',
  styleUrls: ['./image-thumb.component.css']
})
export class ImageThumbComponent {

	@Input() image: any;
	constructor() { }

}
