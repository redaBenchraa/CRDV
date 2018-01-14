import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewAdaptationComponent } from './view-adaptation.component';

describe('ViewAdaptationComponent', () => {
  let component: ViewAdaptationComponent;
  let fixture: ComponentFixture<ViewAdaptationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewAdaptationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewAdaptationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
