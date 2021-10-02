import {Component, Input, OnDestroy} from '@angular/core';
import {ButtonClickService} from "../../services/button-click.service";
import {Subscription} from "rxjs/Subscription";
import {GalleryService} from "../../services/gallery_service";
import {Router} from "@angular/router";
import {Gallery} from '../../models/gallery.model';

declare var $: any;

@Component({
  selector: 'gallery-edit',
  templateUrl: './gallery-edit.component.html',
  styleUrls: ['./gallery-edit.component.css']
})
export class GalleryEditComponent implements OnDestroy {

	private subscription: Subscription;

	@Input() gallery: Gallery;
	addMode: boolean = false;

	tagList = [];
	name: String = '';
	description: String = '';
	useTags: boolean = false;
	showImages: boolean = false;

	constructor(private buttonClickService: ButtonClickService,
	            private galleryService: GalleryService,
	            private router: Router) {
		this.subscription = this.buttonClickService.notifyObservable$.subscribe(
			data => {
				if ((data.name !== 'galleryEditClick') &&
					(data.name !== 'galleryAddClick'))
				{
					return;
				}

				this.addMode = data.name === 'galleryAddClick';

				this.reset();
				$('#edit-modal').modal('show');
				setTimeout(function() {
					$('#inputGalleryParent').select2({
						ajax: {
							url: '/api/gallery_lookup',
							dataType: 'json',
							data: function (params) {
								return  {
									q: params.term,
									page: params.page || 1
								};
							}
						}
					});
					$('#inputGalleryTags').select2({
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
		if (!this.addMode) {
			this.name = this.gallery.name;
			this.description = this.gallery.description;
			this.useTags = this.gallery.useTags;
			this.showImages = this.gallery.combinedView;
		} else
		{
			this.name = '';
			this.description = '';
			this.useTags = true;
			this.showImages = false;
		}
		this.tagList = [];

		for (let tag of this.gallery.tagList) {
			this.tagList.push({name: tag.name, id: ''+tag.id});
		}
	}

	onSubmit() {
		// Select2 isn't synchronising so we have to get the selections manually
		let tagData = $('#inputGalleryTags').select2('data');
		let tags = [];
		for (let tag of tagData)
		{
			tags.push(tag.id);
		}

		let galleryData = $('#inputGalleryParent').select2('data');
		this.gallery.parentGallery.id = galleryData[0].id;

		let id = 0;
		if (!this.addMode)
			id = this.gallery.id;

		this.galleryService.SubmitGallery({
			id: id,
			name: this.name,
			description: this.description,
			parent: this.gallery.parentGallery.id,
			tags: tags,
			useTags: this.useTags,
			showImages: this.showImages
		}).subscribe(data => {
			let options =
			{
				message: 'Gallery saved',
				container: '#editSuccessContainer',
				duration: 5000
			};
			$.meow(options);
			$('#inputGalleryTags').children().remove();
			$('#edit-modal').modal('hide');

			if (this.addMode) {
				this.router.navigate(['/gallery/' + data.message])
			}
		});
	}

	ngOnDestroy(): void {
		this.subscription.unsubscribe();
	}
}
