export class ParentGallery {
    id: number;
    name: string;

    public fromData(data) {
    	this.id = data.id;
	    this.name = data.name;
    }
}
