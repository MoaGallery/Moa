import {Component, Input, OnInit} from '@angular/core';
import {ButtonClickService} from "../../services/button-click.service";
import {Subscription} from "rxjs/Subscription";
import {Router} from "@angular/router";
import {ImageService} from "../image.service";

declare var $: any;

@Component({
  selector: 'image-add',
  templateUrl: './image-add.component.html',
  styleUrls: ['./image-add.component.css']
})
export class ImageAddComponent implements OnInit {

	private subscription: Subscription;

	@Input() gallery;

	file;
	filename: String = '';
	description: String = '';
	tagList = [];

	uploadedFiles: any[] = [];

	constructor(private buttonClickService: ButtonClickService,
	            private imageService: ImageService,
	            private router: Router) {
		this.subscription = this.buttonClickService.notifyObservable$.subscribe(
			data => {
				if (data.name !== 'imageAddClick')
					return;

				this.reset();
				$('#add-modal').modal('show');
				setTimeout(function() {
					$('#inputImageTags').select2({
						tags: true,
						ajax: {
							url: '/api/tag_lookup',
							dataType: 'json',
							data: function (params) {
								return  {
									q: params.term,
									page: params.page || 1
								};
							}
						}
					});
				}, 0);
			}
		)
	}

	reset() {
		this.description = '';
		this.tagList = [];

		for (let tag of this.gallery.tag_list) {
			this.tagList.push({name: tag.name, id: ''+tag.id});
		}
	}

	onSubmit() {
		// Select2 isn't synchronising so we have to get the selections manually
		let tagData = $('#inputImageTags').select2('data');
		let tags = [];
		for (let tag of tagData)
		{
			tags.push(tag.id);
		}

		let files = this.uploadedFiles.map((file) => {
			return file.hash
		});

		/*this.imageService.SubmitImages({
			id: 0,
			gallery_id: this.gallery.id,
			description: this.description,
			tags: tags,
			fileHashes: files
		}).subscribe(data => {
			let options =
				{
					message: 'Image saved',
					container: '#editSuccessContainer',
					duration: 5000
				};
			$.meow(options);
			$('#inputImageTags').children().remove();
			$('#add-modal').modal('hide');

			if (files.length === 1)
				this.router.navigate(['/image/' + this.gallery.id + '/' + data.message]);
		});*/
	}

	ngOnInit() {
	}

	onUpload(event) {
		let response = JSON.parse(event.xhr.response);

		for (let file of event.files) {
			let hash = '';

			for (let r of response) {
				if (r.filename === file.name)
					hash = r.hash;
			}

			file.hash = hash;
			this.uploadedFiles.push(file);
		}
	}

	fileDelete($event, file) {
		$event.preventDefault();
		console.log(file);
		let fileIndex = -1;
		for (let {item, index} of this.uploadedFiles.map((item, index) => ({ item, index })))
		{
			if (item.hash === file.hash)
				fileIndex = index;
		}

		if (fileIndex > -1)
			this.uploadedFiles.splice(fileIndex, 1);
	}
}
