import {Tag} from './tag.model';
import {ParentGallery} from './parent-gallery.model';
import {isArrayLike, isNumeric} from 'rxjs/internal-compatibility';

export class Gallery {
    id: number;
    name: string;
    thumbId: number;
    parentId: number;
    parentGallery: ParentGallery;
    tagList: Array<Tag>;
    description: string;
    useTags: boolean;
    combinedView: boolean;

    constructor(){
        this.fromData({
	        id: 0,
	        name: '',
	        thumbId: 0,
	        parentId: 0,
	        tagList: [],
	        description: 'description',
	        useTags: true,
	        combinedView: false
        });
    }

    public fromData(data) {
    	if (isNumeric(data.id))
    	    this.id = data.id;
    	if (typeof data.name === 'string')
	        this.name = data.name;
	    if (isNumeric(data.thumbId))
		    this.thumbId = data.thumbId;
	    if (isNumeric(data.parentId))
		    this.parentId = data.parentId;
	    if (typeof data.parentGallery === 'object') {
		    this.parentGallery.id = data.parentGallery.id;
		    this.parentGallery.name = data.parentGallery.name;
	    }
	    if (Array.isArray(data.tagList))
		    this.tagList = data.tagList;
	    if (typeof data.description === 'string')
		    this.description = data.description;
	    if (typeof data.useTags === 'boolean')
		    this.useTags = data.useTags;
	    if (typeof data.combinedView === 'boolean')
		    this.combinedView= data.combinedView;
    }
}
