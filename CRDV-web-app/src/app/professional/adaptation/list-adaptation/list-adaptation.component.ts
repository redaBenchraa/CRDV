import { Component, OnInit } from '@angular/core';
import {Page} from '../../../model/page';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-list-adaptation',
  templateUrl: './list-adaptation.component.html',
  styleUrls: ['./list-adaptation.component.scss']
})
export class ListAdaptationComponent implements OnInit {

  page = new Page();

  rows = [
    { id : 1, intitule: 'Austin', category: 'Male', type: 'Swimlane' },
    { id : 2, intitule: 'Dany', category: 'Male', type: 'KFC' },
    { id : 3, intitule: 'Molly', category: 'Female', type: 'Burger King' },
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
