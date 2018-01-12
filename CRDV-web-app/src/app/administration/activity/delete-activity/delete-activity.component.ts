import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-delete-activity',
  templateUrl: './delete-activity.component.html',
  styleUrls: ['./delete-activity.component.scss']
})
export class DeleteActivityComponent implements OnInit {

  constructor(private activatedRoute: ActivatedRoute, private router: Router) { }

  ngOnInit() {
  }
  goBack() {
    this.router.navigate(['../../list'], {relativeTo: this.activatedRoute});
  }

}
