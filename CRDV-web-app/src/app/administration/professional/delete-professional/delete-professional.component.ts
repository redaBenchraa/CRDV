import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-delete-professional',
  templateUrl: './delete-professional.component.html',
  styleUrls: ['./delete-professional.component.scss']
})
export class DeleteProfessionalComponent implements OnInit {

  constructor(private activatedRoute: ActivatedRoute, private router: Router) { }

  ngOnInit() {
  }
  goBack() {
    this.router.navigate(['../../list'], {relativeTo: this.activatedRoute});
  }
}
