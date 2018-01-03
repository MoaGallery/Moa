import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';


import { AppComponent } from './app.component';
import { BreadcrumbComponent } from './breadcrumb/breadcrumb.component';
import { GalleryListComponent } from './gallery/gallery-list/gallery-list.component';
import { GalleryTileComponent } from './gallery/gallery-tile/gallery-tile.component';
import {DataService} from "./services/data.service";
import {HttpClientModule} from "@angular/common/http";


@NgModule({
  declarations: [
    AppComponent,
    BreadcrumbComponent,
    GalleryListComponent,
    GalleryTileComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule
  ],
  providers: [DataService],
  bootstrap: [AppComponent]
})
export class AppModule { }
