import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-delete-adaptation',
  templateUrl: './delete-adaptation.component.html',
  styleUrls: ['./delete-adaptation.component.scss']
})
export class DeleteAdaptationComponent implements OnInit {

  constructor(private activatedRoute: ActivatedRoute, private router: Router) { }

  ngOnInit() {
  }
  goBack() {
    this.router.navigate(['../../list'], {relativeTo: this.activatedRoute});
  }

}
