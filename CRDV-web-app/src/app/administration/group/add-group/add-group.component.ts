import { Component, OnInit } from '@angular/core';
import {Page} from '../../../model/page';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-add-group',
  templateUrl: './add-group.component.html',
  styleUrls: ['./add-group.component.scss']
})
export class AddGroupComponent implements OnInit {

  page = new Page();

  rows = [
    { id : 1, nom: 'Austin', prenom : 'zzz', dateDeNaissance : '12/02/1465' },
    { id : 2, nom: 'Dany', prenom : 'zzz', dateDeNaissance : '12/02/1465' },
    { id : 3, nom: 'Molly', prenom : 'zzz', dateDeNaissance : '12/02/1465'},
  ];
  selectedUsager = [this.rows[0]];

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
  goBack() {
    this.router.navigate(['../list'], {relativeTo: this.activatedRoute});
  }
  onSelect(selected) {
    console.log(selected);
  }
}
