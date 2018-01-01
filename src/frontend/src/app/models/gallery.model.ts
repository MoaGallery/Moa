export class Gallery {
    id: number;
    name: string;
    thumbUrl: string;

    constructor(id: number, name: string, thumbUrl: string){
        this.id = id;
        this.name = name;
        this.thumbUrl = thumbUrl;
    }
}