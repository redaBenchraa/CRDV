import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-add-adaptation',
  templateUrl: './add-adaptation.component.html',
  styleUrls: ['./add-adaptation.component.scss']
})
export class AddAdaptationComponent implements OnInit {

  constructor(private activatedRoute: ActivatedRoute, private router: Router) { }

  ngOnInit() {
  }
  goBack() {
    this.router.navigate(['../list'], {relativeTo: this.activatedRoute});
  }

}
