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
	addMode: boolean = false;

	id: String = '0';
	tagList = [];
	description: String = '';
	tags: Array<String> = [];

	constructor(private buttonClickService: ButtonClickService,
	            private imageService: ImageService,
	            private router: Router) {
		this.subscription = this.buttonClickService.notifyObservable$.subscribe(
			data => {
				if ((data.name !== 'imageEditClick') &&
					(data.name !== 'imageAddClick'))
				{
					return;
				}

				this.addMode = data.name === 'imageAddClick';

				this.reset();
				$('#edit-modal').modal('show');
				setTimeout(function() {
					$('#inputImageTags').select2();
				}, 0);
			}
		)
	}

	reset() {
		if (!this.addMode) {
			this.id = ''+this.image.id;
			this.description = this.image.description;
		} else
		{
			this.id = '0';
			this.description = '';
		}
		this.tagList = [];

		this.tags.splice(0, this.tags.length);
		for (let tag of this.image.tag_list) {
			this.tagList.push({name: tag.name, id: ''+tag.id});
			if ((!this.addMode) &&
				(tag.selected !== undefined))
			{
				this.tags.push('' + tag.id);
			}
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

		let id = 0;
		if (!this.addMode)
			id = this.image.id;

		this.imageService.SubmitImage({
			id: id,
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

			if (this.addMode) {
				this.router.navigate(['/image/' + this.image.gallery_id + '/' + data.message]);
			}
		});
	}

	ngOnInit() {
	}

}
