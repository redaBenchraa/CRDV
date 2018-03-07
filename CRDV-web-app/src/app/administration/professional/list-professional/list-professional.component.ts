import { Component, OnInit } from '@angular/core';
import {Page} from '../../../model/page';
import {ActivatedRoute, Router} from '@angular/router';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-list-professional',
  templateUrl: './list-professional.component.html',
  styleUrls: ['./list-professional.component.scss']
})
export class ListProfessionalComponent implements OnInit {
  professional: any;
  page = new Page();
  rows = [];
  rowsOriginal = [];
  search = '';
  constructor(private httpService: HttpService, private activatedRoute: ActivatedRoute, private router: Router) {
    this.professional = JSON.parse(localStorage.getItem('user'));
    if (this.professional === null) {
      this.router.navigate(['start']);
    }
    this.getProfessionals(1);
  }

  ngOnInit() {
  }

  onSearchChange() {
    console.log(this.search);
    this.rows = this.rowsOriginal;
    if (this.search !== '') {
      this.search = this.search.toLowerCase();
      this.rows = this.rows.filter(
        x => x.nom.toLowerCase().indexOf(this.search) > -1 || x.prenom.toLowerCase().indexOf(this.search) > -1 );
    }
  }
  add() {
    this.router.navigate(['../add'], {relativeTo: this.activatedRoute});
  }

  getProfessionals(page) {
    console.log(this.professional);
    this.httpService.getPros(this.professional['centre_id'], page).subscribe(
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
