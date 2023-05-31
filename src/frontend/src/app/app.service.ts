import {Injectable} from "@angular/core";
import {HttpClient} from "@angular/common/http";
import {throwError, Observable} from "rxjs";
import {catchError, tap} from 'rxjs/operators';

@Injectable()
export class AppService {
	protected api_url: string = '/api/other/';

	constructor(private http: HttpClient) {
	}

	private handleError(err: any) {
		// in a real world app, we may send the server to some remote logging infrastructure
		// instead of just logging it to the console
		let errorMessage: string;
		if (err.error instanceof ErrorEvent) {
			// A client-side or network error occurred. Handle it accordingly.
			errorMessage = `An error occurred: ${err.error.message}`;
		} else {
			// The backend returned an unsuccessful response code.
			// The response body may contain clues as to what went wrong,
			errorMessage = `Backend returned code ${err.status}: ${err.body.error}`;
		}
		console.error(err);
		return throwError(errorMessage);
	}
	getOtherData(): Observable<{galleries: [], tags: []}> {
		return this.http.get<{galleries: [], tags: []}>(this.api_url)
			.pipe(
				/*tap(data => console.log(JSON.stringify(data))),*/
				catchError(this.handleError)
			);
	}
}
