import {Component, Input, OnDestroy} from '@angular/core';
import {ButtonClickService} from "../../services/button-click.service";
import {Subscription} from "rxjs/Subscription";
import {GalleryService} from "../../services/gallery_service";

declare var $: any;

@Component({
  selector: 'gallery-edit',
  templateUrl: './gallery-edit.component.html',
  styleUrls: ['./gallery-edit.component.css']
})
export class GalleryEditComponent implements OnDestroy {

	private subscription: Subscription;

	@Input() gallery;

	tagList = [];
	galleryList = [];

	name: String = '';
	description: String = '';
	tags: Array<String> = [];
	parent: String = '';
	useTags: boolean = false;
	showImages: boolean = false;

	constructor(private buttonClickService: ButtonClickService, private galleryService: GalleryService) {
		this.subscription = this.buttonClickService.notifyObservable$.subscribe(
			data => {
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
		this.name = this.gallery.name;
		this.description = this.gallery.description;
		this.useTags = this.gallery.use_tags == 1;
		this.showImages = this.gallery.combined_view == 1;
		this.tagList = [];
		this.galleryList = [];

		this.tags = [];
		for (let tag of this.gallery.tag_list) {
			this.tagList.push({name: tag.name, id: ''+tag.id});
			if (tag.selected !== undefined)
				this.tags.push(''+tag.id);
		}

		for (let gallery of this.gallery.gallery_list) {
			this.galleryList.push(gallery);
			if (gallery.selected !== undefined)
				this.parent = '' + gallery.id;
		}
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
		this.parent = galleryData[0].id;

		this.galleryService.EditGallery({
			id: this.gallery.id,
			name: this.name,
			description: this.description,
			parent: this.parent,
			tags: tags,
			useTags: this.useTags,
			showImages: this.showImages
		}).subscribe(data => {
			console.log(data);
			let options =
			{
				message: 'Gallery saved',
				container: '#editSuccessContainer',
				duration: 5000
			};
			$.meow(options);
			$('#edit-modal').modal('hide');
		});
	}

	ngOnDestroy(): void {
		this.subscription.unsubscribe();
	}
}
