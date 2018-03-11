import {ChangeDetectorRef, Component, OnInit} from '@angular/core';
import {duration} from 'moment';
import {HttpService} from '../../../Service/HttpService';
import {Router} from '@angular/router';

@Component({
  selector: 'app-new-activity',
  templateUrl: './new-activity.component.html',
  styleUrls: ['./new-activity.component.scss']
})
export class NewActivityComponent implements OnInit {
  user: any;
  search = '';
  selectedCategorie: any= [];
  selectedActivite= [];
  selectedGroupe= [];
  selectedUsager= [];
  selectedProffessionelle= [];
  model= {
    'activity' : true,
    'usager' : 1,
    'duration' : 45,
    'date' : this.getDate(),
  };
  rowsCategorie: any = [];
  rowsActivite: any = [];
  rowsUsager: any = [];
  rowsGroupe: any = [];
  rowsCategorieAll: any = [];
  rowsActiviteAll: any = [];
  rowsUsagerAll: any = [];
  rowsGroupeAll: any = [  ];
  durationDirecte: any = [];
  durationIndirecte: any = [];
  params: any = {
    'directe': 45,
    'indirecte': 60,
  };
  constructor(private  changeDetector: ChangeDetectorRef, private router: Router, private httpService: HttpService) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['/login']);
    }
    this.getCats();
    this.getParams();
    this.getUsers();
    this.getGroups();
  }
  getCats() {
    this.httpService.getCats(this.user.centre_id, 0).subscribe(
      data => {
        console.log(data);
        this.rowsCategorie = data['data'];
        this.rowsCategorieAll = data['data'];
      }, error => {
        console.error(error);
      }
    );
  }
  getActivities(id) {
    this.httpService.getActivities(id).subscribe(
      data => {
        console.log(data);
        this.rowsActivite = data['data'];
        this.rowsActiviteAll = data['data'];
        this.activityTypeClick(true);
      }, error => {
        console.error(error);
      }
    );
  }
  getDate() {
    const local = new Date();
    local.setMinutes(local.getMinutes() - local.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
  }
  activityTypeClick(type) {
    this.rowsActivite = this.rowsActiviteAll;
    this.rowsActivite = this.rowsActivite.filter(x => x.type === type);
  }
  getParams() {
    this.httpService.getParams(this.user.centre_id).subscribe(
      data => {
        console.log(data);
        for (const par of data['data']){
          if (par.nom === 'directe') {
            this.params['directe'] = Number(par.valeur);
          }
          if (par.nom === 'indirecte') {
            this.params['indirecte'] = Number(par.valeur);
          }
        }
        for (let i = 1; i < 40; i++) {
          if (i <= 10) {
            this.durationDirecte.push({'value': this.params['directe'] * i, 'lable': this.getLabel(this.params['directe'] * i)});
          }
          this.durationIndirecte.push({'value': this.params['indirecte'] * i, 'lable': this.getLabel(this.params['indirecte'] * i)});
        }
        console.log('Param : ');
        console.log(this.params);
        console.log('Directe : ');
        console.log(this.durationDirecte);
        console.log('Indirect :');
        console.log(this.durationIndirecte);
      }, error => {
        console.error(error);
      }
    );
  }
  getLabel(min) {
    const hours = Math.floor(min / 60);
    const realMin = (min % 60 < 10)  ? '0' + min % 60 : min % 60;
    return ( hours === 0 ) ? realMin + 'min' : hours + 'h' + realMin + 'min';
  }
  getGroups() {
    this.httpService.getGroups(this.user.centre_id, 0).subscribe(
      data => {
        this.rowsGroupe = data['data'];
        this.rowsGroupeAll = data['data'];
        console.log(data);
      }, error => {
        console.error(error);
      }
    );
  }
  getUsers() {
    this.httpService.getUsers(this.user.centre_id, 0).subscribe(
      data => {
        this.rowsUsager = data['data'];
        this.rowsUsagerAll = data['data'];
        console.log(data);
      }, error => {
        console.error(error);
      }
    );
  }
  ngOnInit() {
    const that = this;
    $('.selectTime').on('click', '.placeholder', function(){
      const parent = $(this).closest('.selectTime');
      if ( ! parent.hasClass('is-open')) {
        parent.addClass('is-open');
        $('.selectTime.is-open').not(parent).removeClass('is-open');
      }else {
        parent.removeClass('is-open');
      }
    }).on('click', 'ul>li', function(){
      const parent = $(this).closest('.selectTime');
      that.model['duration'] = Number($(this).attr('value'));
      parent.removeClass('is-open').find('.placeholder').text( $(this).text() );
      parent.find('input[type=hidden]').attr('value', $(this).attr('data-value') );
    });
  }
  onSelect(index, { selected }) {
    // console.log(this.model);
    switch (index) {
      case 1 :
        console.log('Cat ' + this.selectedCategorie[0].id + ' Selected');
        console.log(this.selectedCategorie);
        this.getActivities(this.selectedCategorie[0]['id']);
        break;
      case 2 :
        console.log(this.selectedActivite);
        break;
      case 3 :
        console.log(this.selectedUsager);
        break;
      case 4 :
        console.log(this.selectedGroupe);
        this.getUsagers(this.selectedGroupe[0]['id']);
        break;

    }
    this.changeDetector.detectChanges();
  }
  getActivityType() {
    if (this.model.activity) {
      return 'Directe';
    } else {
      return 'Indirecte';
    }
  }
  getUsagerType() {
    if (this.model.usager) {
      return 'Individuel';
    } else {
      return 'Groupe';
    }
  }
  getUsagers(id) {
    this.httpService.getGroupUsers(id).subscribe(
      data => {
        console.log(data);
        this.rowsUsager = data['data'];
        this.rowsUsagerAll = data['data'];
        for (const u of this.rowsUsager){
          this.selectedUsager.push(u);
        }
      }, error => {
        console.error(error);
      }
    );
  }
  getSelectedCategorie() {
    if ( this.selectedCategorie.length === 0 ) {
      return ' ';
    }else {
      return this.selectedCategorie[0].intitule;
    }
  }
  getSelectedActivite() {
    if ( this.selectedActivite.length === 0 ) {
      return ' ';
    }else {
      return this.selectedActivite[0].intitule;
    }
  }
  getSelectedSerafanCode() {
    if ( this.selectedActivite.length === 0 ) {
      return ' ';
    }else {
      return this.selectedActivite[0].serafin.code;
    }
  }
  getSelectedSerafanIntitule() {
    if ( this.selectedActivite.length === 0 ) {
      return ' ';
    }else {
      return this.selectedActivite[0].serafin.intitule;
    }
  }

  searchCategory() {
    if (this.search !== '') {
      this.rowsCategorie = this.rowsCategorieAll;
      this.rowsCategorie = this.rowsCategorie.filter(x => x.intitule.toLowerCase().indexOf(this.search.toLowerCase()) > -1);
    }else {
      this.rowsCategorie = this.rowsCategorieAll;
    }
  }
  searchActivity() {
    this.activityTypeClick(this.model['activity']);
    if (this.search !== '') {
      this.rowsActivite = this.rowsActivite.filter(x =>
      x.intitule.toLowerCase().indexOf(this.search.toLowerCase()) > -1 ||
      x.serafin.code.toLowerCase().indexOf(this.search.toLowerCase()) > -1);
    }
  }
  searchUsers() {
    if (this.model['usager'] === 2) {
      if (this.search !== '') {
        this.rowsGroupe = this.rowsGroupeAll;
        this.rowsGroupe = this.rowsGroupe.filter(x => x.nom.toLowerCase().indexOf(this.search.toLowerCase()) > -1);
      }else {
        this.rowsGroupe = this.rowsGroupeAll;
      }
    }else {
      if (this.search !== '') {
        this.rowsUsager = this.rowsUsagerAll;
        this.rowsUsager = this.rowsUsager.filter(x => x.nom.toLowerCase().indexOf(this.search.toLowerCase()) > -1 ||
        x.prenom.toLowerCase().indexOf(this.search.toLowerCase()) > -1);
      }else {
        this.rowsUsager = this.rowsUsagerAll;
      }
    }
  }

}
