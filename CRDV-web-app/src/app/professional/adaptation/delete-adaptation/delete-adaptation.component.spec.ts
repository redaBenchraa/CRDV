import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DeleteAdaptationComponent } from './delete-adaptation.component';

describe('DeleteAdaptationComponent', () => {
  let component: DeleteAdaptationComponent;
  let fixture: ComponentFixture<DeleteAdaptationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DeleteAdaptationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DeleteAdaptationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
