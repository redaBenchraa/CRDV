import { Component, OnInit } from '@angular/core';
import {Page} from '../../../model/page';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-list-professional',
  templateUrl: './list-professional.component.html',
  styleUrls: ['./list-professional.component.scss']
})
export class ListProfessionalComponent implements OnInit {

  page = new Page();

  rows = [
    { id : 1, nom: 'Austin', prenom : 'zzz' },
    { id : 2, nom: 'Dany', prenom : 'zzz' },
    { id : 3, nom: 'Molly', prenom : 'zzz'},
  ];

  constructor(private activatedRoute: ActivatedRoute, private router: Router) {
    this.page.totalPages = 7;
    this.page.totalElements = 21;
    this.page.size = 3;
    this.page.pageNumber = 0;
  }

  ngOnInit() {
  }

  setPage(pageInfo) {
    this.page.pageNumber = pageInfo.offset;
    alert(this.page.pageNumber);
    console.log(pageInfo);
  }
  add() {
    this.router.navigate(['../add'], {relativeTo: this.activatedRoute});
  }

}
