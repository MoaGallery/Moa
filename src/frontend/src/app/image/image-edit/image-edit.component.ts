import {Component, Input, OnInit} from '@angular/core';
import {ButtonClickService} from "../../services/button-click.service";
import {Subscription} from "rxjs/Subscription";
import {Router} from "@angular/router";
import {ImageService} from "../../services/image_service";

declare var $: any;

@Component({
  selector: 'image-edit',
  templateUrl: './image-edit.component.html',
  styleUrls: ['./image-edit.component.css']
})
export class ImageEditComponent implements OnInit {

	private subscription: Subscription;

	@Input() image;

	id: String = '0';
	tagList = [];
	description: String = '';
	tags: Array<String> = [];

	constructor(private buttonClickService: ButtonClickService,
	            private imageService: ImageService,
	            private router: Router) {
		this.subscription = this.buttonClickService.notifyObservable$.subscribe(
			data => {
				if (data.name !== 'imageEditClick')
					return;

				this.reset();
				$('#edit-modal').modal('show');
				setTimeout(function() {
					$('#inputImageTags').select2();
				}, 0);
			}
		)
	}

	reset() {
		this.id = ''+this.image.id;
		this.description = this.image.description;
		this.tagList = [];

		this.tags.splice(0, this.tags.length);
		for (let tag of this.image.tag_list) {
			this.tagList.push({name: tag.name, id: ''+tag.id});
			if (tag.selected !== undefined)
				this.tags.push('' + tag.id);
		}

		$('#inputGalleryTags').val(this.tags);
	}

	onSubmit() {
		// Select2 isn't synchronising so we have to get the selections manually
		let tagData = $('#inputImageTags').select2('data');
		let tags = [];
		for (let tag of tagData)
		{
			const regex = /'(tag-id-\w+)'/g;
			let m;

			if ((m = regex.exec(tag.id)) !== null) {
				// The result can be accessed through the `m`-variable.
				m.forEach((match, groupIndex) => {
					if (groupIndex === 1)
						tags.push(match);
				});
			}
		}

		this.imageService.SubmitImage({
			id: this.image.id,
			gallery_id: this.image.gallery_id,
			description: this.description,
			tags: tags,
		}).subscribe(data => {
			let options =
				{
					message: 'Image saved',
					container: '#editSuccessContainer',
					duration: 5000
				};
			$.meow(options);
			$('#edit-modal').modal('hide');
		});
	}

	ngOnInit() {
	}

}
