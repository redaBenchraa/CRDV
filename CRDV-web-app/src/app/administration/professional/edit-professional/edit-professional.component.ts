import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-edit-professional',
  templateUrl: './edit-professional.component.html',
  styleUrls: ['./edit-professional.component.scss']
})
export class EditProfessionalComponent implements OnInit {

  constructor(private activatedRoute: ActivatedRoute, private router: Router) { }

  ngOnInit() {
  }
  goBack() {
    this.router.navigate(['../../list'], {relativeTo: this.activatedRoute});
  }
}
