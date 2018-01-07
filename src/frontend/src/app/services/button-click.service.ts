import { Injectable } from '@angular/core';
import {Subject} from "rxjs/Subject";

@Injectable()
export class ButtonClickService {

	private notify = new Subject<any>();
	notifyObservable$ = this.notify.asObservable();

	constructor() {}

	public trigger(data: any) {
		if (data) {
			this.notify.next(data);
		}
	}
}
