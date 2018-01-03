import {Component, ElementRef, OnInit} from '@angular/core';
import {DataService} from "../../services/data.service";

@Component({
    selector: 'moa',
    templateUrl: './home-page.component.html',
    styleUrls: ['./home-page.component.css']
})
export class HomePageComponent implements OnInit {
    constructor() {
    }

    ngOnInit(): void {
    }
}
