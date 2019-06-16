export class Gallery {
    id: number;
    name: string;
    thumb_id: number;

    constructor(id: number, name: string, thumb_id: number){
        this.id = id;
        this.name = name;
        this.thumb_id = thumb_id;
    }
}
