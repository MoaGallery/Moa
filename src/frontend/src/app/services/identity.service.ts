import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class IdentityService
{
	rights = {
		isAdmin: false
	};

	public SetRights(rights)
	{
		this.rights.isAdmin = rights.isAdmin;
	}

	public isAdmin() {
		return this.rights.isAdmin;
	}
}
