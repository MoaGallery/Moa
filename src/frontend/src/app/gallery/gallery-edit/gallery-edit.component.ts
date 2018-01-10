import {Component, Input, OnDestroy} from '@angular/core';
import {ButtonClickService} from "../../services/button-click.service";
import {Subscription} from "rxjs/Subscription";
import {GalleryService} from "../../services/gallery_service";
import {Router} from "@angular/router";

declare var $: any;

@Component({
  selector: 'gallery-edit',
  templateUrl: './gallery-edit.component.html',
  styleUrls: ['./gallery-edit.component.css']
})
export class GalleryEditComponent implements OnDestroy {

	private subscription: Subscription;

	@Input() gallery;
	addMode: boolean = false;

	tagList = [];
	galleryList = [];

	name: String = '';
	description: String = '';
	tags: Array<String> = [];
	parent_id: String = '';
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
					$('#inputGalleryParent').select2();
					$('#inputGalleryTags').select2();
				}, 0);
			}
		)
	}

	reset() {
		this.parent_id = this.gallery.parent_id;
		if (this.addMode)
			this.parent_id = ''+this.gallery.id;

		if (!this.addMode) {
			this.name = this.gallery.name;
			this.description = this.gallery.description;
			this.useTags = this.gallery.use_tags == 1;
			this.showImages = this.gallery.combined_view == 1;
		} else
		{
			this.name = '';
			this.description = '';
			this.useTags = true;
			this.showImages = false;
		}
		this.tagList = [];
		this.galleryList = [];

		this.tags.splice(0, this.tags.length);
		for (let tag of this.gallery.tag_list) {
			this.tagList.push({name: tag.name, id: ''+tag.id});
			if ((!this.addMode) &&
				(tag.selected !== undefined))
			{
				this.tags.push('' + tag.id);
			}
		}

		for (let gallery of this.gallery.gallery_list) {
			this.galleryList.push(gallery);

			if (this.addMode) {
				this.galleryList.push({
					id: this.gallery.id,
					name: this.gallery.name
				});
			}
		}

		$('#inputGalleryParent').val(this.parent_id);
		$('#inputGalleryTags').val(this.tags);
	}

	onSubmit() {
		// Select2 isn't synchronising so we have to get the selections manually
		let tagData = $('#inputGalleryTags').select2('data');
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

		let galleryData = $('#inputGalleryParent').select2('data');
		this.parent_id = galleryData[0].id;

		let id = 0;
		if (!this.addMode)
			id = this.gallery.id;

		this.galleryService.SubmitGallery({
			id: id,
			name: this.name,
			description: this.description,
			parent: this.parent_id,
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
