import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';


import { AppComponent } from './app.component';
import { BreadcrumbComponent } from './breadcrumb/breadcrumb.component';
import { GalleryListComponent } from './gallery/gallery-list/gallery-list.component';
import { GalleryTileComponent } from './gallery/gallery-tile/gallery-tile.component';
import { DataService } from "./services/data.service";
import { PageTitleService } from "./services/page_title.service";
import { PageDataService } from "./services/page_data.service";
import { HttpClientModule } from "@angular/common/http";
import { RouterModule, Routes } from "@angular/router";
import { GalleryPageComponent } from './pages/gallery-page/gallery-page.component';
import { HomePageComponent } from './pages/home-page/home-page.component';
import { GalleryInfoComponent } from './gallery/gallery-info/gallery-info.component';
import { ImageListComponent } from './image/image-list/image-list.component';
import { ImageThumbComponent } from './image/image-thumb/image-thumb.component';
import { GalleryToolbarComponent } from './gallery/gallery-toolbar/gallery-toolbar.component';
import { GalleryEditComponent } from './gallery/gallery-edit/gallery-edit.component';
import { ButtonClickService } from "./services/button-click.service";
import { FormsModule } from "@angular/forms";
import { GalleryService } from "./services/gallery_service";
import { ImageService } from "./services/image_service";
import { ImagePageComponent } from './pages/image-page/image-page.component';
import { ImageInfoComponent } from './image/image-info/image-info.component';
import { ImageToolbarComponent } from './image/image-toolbar/image-toolbar.component';
import { ImageEditComponent } from './image/image-edit/image-edit.component';
import { ThumbnailService } from "./services/thumbnail.service";
import { ImageAddComponent } from "./image/image-add/image-add.component";
import { FileUploadModule } from 'primeng/fileupload';
import { HomeToolbarComponent } from "./home/home-toolbar/home-toolbar.component";
import { NgBoxService } from "./ngbox/ngbox.service";
import { NgBoxComponent } from "./ngbox/ngbox.component";
import { NgBoxDirective } from "./ngbox/ngbox.directive";
import {EntityDataModule, EntityDataService, EntityDefinitionService, EntityDispatcherDefaultOptions, EntityMetadataMap} from '@ngrx/data';
import {GalleryDataService} from './services/gallery.data.service';
import {StoreModule} from '@ngrx/store';
import {EffectsModule} from '@ngrx/effects';
import {StoreDevtoolsModule} from '@ngrx/store-devtools';
import {environment} from '../environments/environment';
import {metaReducers, reducers} from './reducers';
import {GalleryEntityService} from './services/gallery-entity.service';
import {GalleryResolver} from './gallery.resolver';
import {RouterState, StoreRouterConnectingModule} from '@ngrx/router-store';
import {SimpleGalleryDataService} from './services/simple_gallery.data.service';
import {SimpleGalleryEntityService} from './services/simple_gallery-entity.service';

const routes: Routes = [
	{
		path: '',
		component: HomePageComponent
	},
	{
		path: 'gallery/:id',
		component: GalleryPageComponent,
		resolve: {
			//gallery: GalleryResolver
		}
	},
	{
		path: 'image/:gallery_id/:image_id',
		component: ImagePageComponent
	}
];

const entityMetadata: EntityMetadataMap = {
	Gallery: {
		entityDispatcherOptions: {
			optimisticUpdate: true
		}
	},
	SimpleGallery: {}
};

@NgModule({
	declarations: [
		AppComponent,
		BreadcrumbComponent,

		GalleryListComponent,
		GalleryTileComponent,
		GalleryInfoComponent,
		GalleryToolbarComponent,
		GalleryEditComponent,

		ImageListComponent,
		ImageThumbComponent,
		ImageInfoComponent,

		HomeToolbarComponent,

		// Route pages
		HomePageComponent,
		GalleryPageComponent,
		ImagePageComponent,
		ImageToolbarComponent,
		ImageEditComponent,
		ImageAddComponent,

		NgBoxComponent,
		NgBoxDirective
	],
	imports: [
		BrowserModule,
		HttpClientModule,
		RouterModule.forRoot(routes, {}),
		FormsModule,
		FileUploadModule,
		StoreModule.forRoot(reducers, {
			metaReducers,
			runtimeChecks : {
				strictStateImmutability: true,
				strictActionImmutability: true,
				strictActionSerializability: true,
				strictStateSerializability:true
			}
		}),
		StoreDevtoolsModule.instrument({maxAge: 25, logOnly: environment.production}),
		EffectsModule.forRoot(),
		EntityDataModule.forRoot({}),
		StoreRouterConnectingModule.forRoot({
			stateKey: 'router',
			routerState: RouterState.Minimal
		})
	],
	providers: [
		DataService,
		PageTitleService,
		PageDataService,
		ButtonClickService,
		GalleryService,
		ImageService,
		ThumbnailService,
		NgBoxService,
		GalleryDataService,
		GalleryEntityService,
		GalleryResolver,
		SimpleGalleryDataService,
		SimpleGalleryEntityService
	],
	bootstrap: [
		AppComponent
	]
})
export class AppModule {
	constructor(
		private eds: EntityDefinitionService,
		private entityDataService: EntityDataService,
		private galleryDataService: GalleryDataService,
		private simpleGalleryDataService: SimpleGalleryDataService
	) {
		eds.registerMetadataMap(entityMetadata);
		entityDataService.registerService('Gallery', this.galleryDataService);
		entityDataService.registerService('SimpleGallery', this.simpleGalleryDataService);
	}
}
