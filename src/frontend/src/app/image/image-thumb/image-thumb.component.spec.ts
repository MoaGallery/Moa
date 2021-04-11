import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';

import { ImageThumbComponent } from './image-thumb.component';

describe('ImageThumbComponent', () => {
  let component: ImageThumbComponent;
  let fixture: ComponentFixture<ImageThumbComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [ ImageThumbComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ImageThumbComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
