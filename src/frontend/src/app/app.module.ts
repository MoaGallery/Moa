import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';


import { AppComponent } from './app.component';
import { BreadcrumbComponent } from './breadcrumb/breadcrumb.component';
import { GalleryListComponent } from './gallery/gallery-list/gallery-list.component';
import { GalleryTileComponent } from './gallery/gallery-tile/gallery-tile.component';
import {DataService} from "./services/data.service";
import {HttpClientModule} from "@angular/common/http";
import {RouterModule, Routes} from "@angular/router";
import { GalleryListPageComponent } from './pages/gallery-list-page/gallery-list-page.component';
import { HomePageComponent } from './pages/home-page/home-page.component';

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
    GalleryListPageComponent,
    HomePageComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    RouterModule.forRoot(routes)
  ],
  providers: [DataService],
  bootstrap: [AppComponent]
})
export class AppModule { }
