import { Component, OnInit } from '@angular/core';
import {Page} from '../../../model/page';
import {ActivatedRoute, Router} from '@angular/router';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-list-user',
  templateUrl: './list-user.component.html',
  styleUrls: ['./list-user.component.scss'],
})
export class ListUserComponent implements OnInit {
  user: any;
  page = new Page();
  rowsOriginal = [];
  rows = [];
  search = '';

  constructor(private httpService: HttpService, private activatedRoute: ActivatedRoute, private router: Router) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['start']);
    }
    this.getUsers(1);
  }
  onSearchChange() {
    console.log(this.search);
    this.rows = this.rowsOriginal;
    if (this.search !== '') {
      this.search = this.search.toLowerCase();
      this.rows = this.rows.filter(
        x => x.nom.toLowerCase().indexOf(this.search) > -1 || x.prenom.toLowerCase().indexOf(this.search) > -1
        ||  x.date_de_naissance.indexOf(this.search) > -1
      );
    }
  }

  ngOnInit() {
  }

  add() {
    this.router.navigate(['../add'], {relativeTo: this.activatedRoute});
  }

  getUsers(page) {
    console.log(this.user);
    this.httpService.getUsers(this.user['centre_id'], page).subscribe(
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
