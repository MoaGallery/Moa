import { ComponentFixture, TestBed, waitForAsync } from '@angular/core/testing';

import { ImageEditComponent } from './image-edit.component';

describe('ImageEditComponent', () => {
  let component: ImageEditComponent;
  let fixture: ComponentFixture<ImageEditComponent>;

  beforeEach(waitForAsync(() => {
    TestBed.configureTestingModule({
      declarations: [ ImageEditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ImageEditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
