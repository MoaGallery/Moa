import {EntityCollectionServiceBase, EntityCollectionServiceElementsFactory} from '@ngrx/data';
import {Gallery} from '../models/gallery';
import {Injectable} from '@angular/core';

@Injectable()
export class GalleryEntityService extends EntityCollectionServiceBase<Gallery> {
	constructor(serviceElementsFactory: EntityCollectionServiceElementsFactory) {
		super('Gallery', serviceElementsFactory);
	}
}
