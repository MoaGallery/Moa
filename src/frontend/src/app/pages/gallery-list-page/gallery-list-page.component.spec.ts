import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GalleryListPageComponentComponent } from './gallery-list-page-component.component';

describe('GalleryListPageComponentComponent', () => {
  let component: GalleryListPageComponentComponent;
  let fixture: ComponentFixture<GalleryListPageComponentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GalleryListPageComponentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GalleryListPageComponentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
