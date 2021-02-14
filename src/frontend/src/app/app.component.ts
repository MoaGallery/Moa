import {Component, ElementRef, OnInit} from '@angular/core';
import {DataService} from "./services/data.service";
import {Router} from "@angular/router";
import {PageTitleService} from "./services/page_title.service";
import {IdentityService} from './services/identity.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
    preload = {
    	rights: {
    		isAdmin: false
	    }
    };
    data = [];

    constructor(private router: Router,
                private service: DataService,
                private pageTitleService: PageTitleService,
                private identityService: IdentityService,
                private elementRef:ElementRef) {
        this.preload = JSON.parse(this.elementRef.nativeElement.getAttribute('[preload]'));
    }

    ngOnInit(): void {
        this.service.setPageData(this.preload);
        this.identityService.SetRights({
	        isAdmin: this.preload.rights.isAdmin
        })
    }
}
