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
import { GalleryListPageComponent } from './pages/gallery-list-page/gallery-list-page.component';
import { HomePageComponent } from './pages/home-page/home-page.component';
import { GalleryInfoComponent } from './gallery/gallery-info/gallery-info.component';
import { ImageListComponent } from './image/image-list/image-list.component';
import { ImageThumbComponent } from './image/image-thumb/image-thumb.component';
import { GalleryToolbarComponent } from './gallery/gallery-toolbar/gallery-toolbar.component';
import { GalleryEditComponent } from './gallery/gallery-edit/gallery-edit.component';
import {ButtonClickService} from "./services/button-click.service";
import {FormsModule} from "@angular/forms";
import {GalleryService} from "./services/gallery_service";

const routes: Routes = [
    { path: '', component: HomePageComponent },
    { path: 'gallery/:id', component: GalleryListPageComponent },
];

@NgModule({
	declarations: [
		AppComponent,
		BreadcrumbComponent,
		GalleryListComponent,
		GalleryTileComponent,
		GalleryInfoComponent,
		ImageListComponent,
		ImageThumbComponent,
		GalleryToolbarComponent,
		GalleryEditComponent,

		// Route pages
		GalleryListPageComponent,
		HomePageComponent
	],
	imports: [
		BrowserModule,
		HttpClientModule,
		RouterModule.forRoot(routes),
		FormsModule
	],
	providers: [
		DataService,
		PageTitleService,
		PageDataService,
		ButtonClickService,
		GalleryService
	],
	bootstrap: [
		AppComponent
	]
})
export class AppModule { }
