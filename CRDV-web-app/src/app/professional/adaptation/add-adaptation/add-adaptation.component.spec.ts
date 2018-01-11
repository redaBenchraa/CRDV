import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddAdaptationComponent } from './add-adaptation.component';

describe('AddAdaptationComponent', () => {
  let component: AddAdaptationComponent;
  let fixture: ComponentFixture<AddAdaptationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddAdaptationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddAdaptationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
