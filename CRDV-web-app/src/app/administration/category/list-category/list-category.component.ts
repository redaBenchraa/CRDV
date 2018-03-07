import { Component, OnInit } from '@angular/core';
import {Page} from '../../../model/page';
import {ActivatedRoute, Router} from '@angular/router';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-list-category',
  templateUrl: './list-category.component.html',
  styleUrls: ['./list-category.component.scss']
})
export class ListCategoryComponent implements OnInit {
  user: any;
  page = new Page();
  rows = [];
  rowsOriginal = [];
  search = '';

  constructor(private httpService: HttpService, private activatedRoute: ActivatedRoute, private router: Router) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['start']);
    }
    this.getCategorys(1);
  }

  ngOnInit() {
  }


  add() {
    this.router.navigate(['../add'], {relativeTo: this.activatedRoute});
  }
  view(id: number) {
    this.router.navigate(['../activites'], {queryParams : {cat: id}, relativeTo: this.activatedRoute});
  }
  onSearchChange() {
    console.log(this.search);
    this.rows = this.rowsOriginal;
    if (this.search !== '') {
      this.search = this.search.toLowerCase();
      this.rows = this.rows.filter(
        x => x.intitule.toLowerCase().indexOf(this.search) > -1);
    }
  }
  getCategorys(page) {
    this.httpService.getCats(this.user['centre_id'], page).subscribe(
      data =>  {
        console.log(data);
        this.updateTable(data);
      }, error => {
        console.error(error);
      }
    );
  }
  updateTable(data) {
    this.page.totalElements = data['data'].length;
    this.rows = data['data'];
    this.rowsOriginal = data['data'];
  }

}
