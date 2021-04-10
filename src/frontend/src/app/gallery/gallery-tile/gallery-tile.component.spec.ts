import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';

import { GalleryTileComponent } from './gallery-tile.component';

describe('GalleryTileComponent', () => {
  let component: GalleryTileComponent;
  let fixture: ComponentFixture<GalleryTileComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [ GalleryTileComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GalleryTileComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
