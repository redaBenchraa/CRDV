import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EditAdaptationComponent } from './edit-adaptation.component';

describe('EditAdaptationComponent', () => {
  let component: EditAdaptationComponent;
  let fixture: ComponentFixture<EditAdaptationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EditAdaptationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EditAdaptationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
