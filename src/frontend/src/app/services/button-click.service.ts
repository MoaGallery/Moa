import { Injectable } from '@angular/core';
import {Subject} from "rxjs/Subject";

@Injectable()
export class ButtonClickService {

	private notify = new Subject<any>();
	notifyObservable$ = this.notify.asObservable();

	constructor() {}

	public trigger(name: string, data: any = null) {
		if (name) {
			this.notify.next({
				name: name,
				data: data
			});
		}
	}
}
