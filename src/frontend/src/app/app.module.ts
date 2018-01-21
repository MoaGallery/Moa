import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';


import { AppComponent } from './app.component';
import { BreadcrumbComponent } from './breadcrumb/breadcrumb.component';
import { GalleryListComponent } from './gallery/gallery-list/gallery-list.component';
import { GalleryTileComponent } from './gallery/gallery-tile/gallery-tile.component';
import {DataService} from "./services/data.service";
import {PageTitleService} from "./services/page_title.service";
import {PageDataService} from "./services/page_data.service";
import {HttpClientModule} from "@angular/common/http";
import {RouterModule, Routes} from "@angular/router";
import { GalleryPageComponent } from './pages/gallery-page/gallery-page.component';
import { HomePageComponent } from './pages/home-page/home-page.component';
import { GalleryInfoComponent } from './gallery/gallery-info/gallery-info.component';
import { ImageListComponent } from './image/image-list/image-list.component';
import { ImageThumbComponent } from './image/image-thumb/image-thumb.component';
import { GalleryToolbarComponent } from './gallery/gallery-toolbar/gallery-toolbar.component';
import { GalleryEditComponent } from './gallery/gallery-edit/gallery-edit.component';
import {ButtonClickService} from "./services/button-click.service";
import {FormsModule} from "@angular/forms";
import {GalleryService} from "./services/gallery_service";
import {ImageService} from "./services/image_service";
import { ImagePageComponent } from './pages/image-page/image-page.component';
import { ImageInfoComponent } from './image/image-info/image-info.component';
import { ImageToolbarComponent } from './image/image-toolbar/image-toolbar.component';
import { ImageEditComponent } from './image/image-edit/image-edit.component';
import {ThumbnailService} from "./services/thumbnail.service";
import {ImageAddComponent} from "./image/image-add/image-add.component";
import {FileUploadModule} from 'primeng/components/fileupload/fileupload';
import {HomeToolbarComponent} from "./home/home-toolbar/home-toolbar.component";

const routes: Routes = [
	{ path: '', component: HomePageComponent },
	{ path: 'gallery/:id', component: GalleryPageComponent },
	{ path: 'image/:gallery_id/:image_id', component: ImagePageComponent }
];

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
		ImageAddComponent
	],
	imports: [
		BrowserModule,
		HttpClientModule,
		RouterModule.forRoot(routes),
		FormsModule,
		FileUploadModule
	],
	providers: [
		DataService,
		PageTitleService,
		PageDataService,
		ButtonClickService,
		GalleryService,
		ImageService,
		ThumbnailService
	],
	bootstrap: [
		AppComponent
	]
})
export class AppModule { }
