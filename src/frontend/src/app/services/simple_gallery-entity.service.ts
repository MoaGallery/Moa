import {EntityCollectionServiceBase, EntityCollectionServiceElementsFactory} from '@ngrx/data';
import {SimpleGallery} from '../models/simple_gallery';
import {Injectable} from '@angular/core';

@Injectable()
export class SimpleGalleryEntityService extends EntityCollectionServiceBase<SimpleGallery> {
	constructor(serviceElementsFactory: EntityCollectionServiceElementsFactory) {
		super('SimpleGallery', serviceElementsFactory);
	}
}
