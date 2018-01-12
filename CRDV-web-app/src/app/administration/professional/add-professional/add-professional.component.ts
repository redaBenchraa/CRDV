import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
@Component({
  selector: 'app-add-professional',
  templateUrl: './add-professional.component.html',
  styleUrls: ['./add-professional.component.scss']
})
export class AddProfessionalComponent implements OnInit {

  constructor(private activatedRoute: ActivatedRoute, private router: Router) { }

  ngOnInit() {
  }
  goBack() {
    this.router.navigate(['../list'], {relativeTo: this.activatedRoute});
  }

}
