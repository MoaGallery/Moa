import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GalleryToolbarComponent } from './gallery-toolbar.component';

describe('GalleryToolbarComponent', () => {
  let component: GalleryToolbarComponent;
  let fixture: ComponentFixture<GalleryToolbarComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GalleryToolbarComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GalleryToolbarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
