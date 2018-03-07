import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {Page} from '../../../model/page';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-show-group',
  templateUrl: './show-group.component.html',
  styleUrls: ['./show-group.component.scss'],
})
export class ShowGroupComponent implements OnInit {
  group: any;
  page = new Page();
  rowsOriginal = [];
  rows = [];
  search = '';
  groupe: any;
  constructor(private httpService: HttpService, private activatedRoute: ActivatedRoute,
              private router: Router, private route: ActivatedRoute) {
    this.group = JSON.parse(localStorage.getItem('user'));
    if (this.group === null) {
      this.router.navigate(['start']);
    }
  }
  onSearchChange() {
    console.log(this.search);
    this.rows = this.rowsOriginal;
    if (this.search !== '') {
      this.search = this.search.toLowerCase();
      this.rows = this.rows.filter(
        x => x.nom.toLowerCase().indexOf(this.search) > -1
        ||  x.prenom.indexOf(this.search) > -1
        ||  x.date_de_naissance.indexOf(this.search) > -1
      );
    }
  }

  ngOnInit() {
    this.route.paramMap.subscribe(params => {
        this.getUsers(params.get('id'));
      this.httpService.getGroup(params.get('id')).subscribe(
        data => {
          console.log(data);
          this.group = data['data'];
        }, error2 => {
          console.error(error2);
        }
      );
    });
  }

  add() {
    this.router.navigate(['../add'], {relativeTo: this.activatedRoute});
  }

  getUsers(id) {
    this.httpService.getGroupUsers(id).subscribe(
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
