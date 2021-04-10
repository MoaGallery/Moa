import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';

import { GalleryEditComponent } from './gallery-edit.component';

describe('GalleryEditComponent', () => {
  let component: GalleryEditComponent;
  let fixture: ComponentFixture<GalleryEditComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [ GalleryEditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GalleryEditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
