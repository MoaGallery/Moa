import {Tag} from './tag.model';
import {ParentGallery} from './parent-gallery.model';

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
}
