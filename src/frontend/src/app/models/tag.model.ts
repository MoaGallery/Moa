export class Tag {
    id: number;
    name: string;

    public fromData(data) {
    	this.id = data.id;
	    this.name = data.name;
    }
}
