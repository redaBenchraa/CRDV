import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListAdaptationComponent } from './list-adaptation.component';

describe('ListAdaptationComponent', () => {
  let component: ListAdaptationComponent;
  let fixture: ComponentFixture<ListAdaptationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListAdaptationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListAdaptationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
