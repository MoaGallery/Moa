import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {StoreModule} from '@ngrx/store';
import {galleryReducer} from './state/gallery.reducer';
import {EffectsModule} from '@ngrx/effects';
import {GalleryEffect} from './state/gallery.effect';


@NgModule({
  declarations: [],
  imports: [
    CommonModule,
	StoreModule.forFeature('gallery', galleryReducer),
	EffectsModule.forFeature([GalleryEffect])
  ]
})
export class GalleryModule { }
