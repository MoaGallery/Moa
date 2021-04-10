import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';

import { GalleryToolbarComponent } from './gallery-toolbar.component';

describe('GalleryToolbarComponent', () => {
  let component: GalleryToolbarComponent;
  let fixture: ComponentFixture<GalleryToolbarComponent>;

  beforeEach(waitForAsync(() => {
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
