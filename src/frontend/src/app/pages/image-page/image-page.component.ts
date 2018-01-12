import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from "@angular/router";
import {PageDataService} from "../../services/page_data.service";

@Component({
  selector: 'image-page',
  templateUrl: './image-page.component.html',
  styleUrls: ['./image-page.component.css']
})
export class ImagePageComponent implements OnInit {

  constructor(private route: ActivatedRoute,
              private page_data_service: PageDataService) { }

  ngOnInit() {
	  this.route.params.subscribe(params => {
		  this.page_data_service.GetImagePageData(params['image_id'], params['gallery_id']);
	  });
  }

}
