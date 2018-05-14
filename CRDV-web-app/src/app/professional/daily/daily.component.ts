import { Component, OnInit } from '@angular/core';
import {HttpService} from '../../../Service/HttpService';
import {Router} from '@angular/router';

@Component({
  selector: 'app-daily',
  templateUrl: './daily.component.html',
  styleUrls: ['./daily.component.scss']
})
export class DailyComponent implements OnInit {
  user: any;
  days = [
    'Dimanche',
    'Lundi',
    'Mardi',
    'Mercredi',
    'Jeudi',
    'Vendredi',
    'Samedi'
  ];
  selected: any = null;
  selectedUsager: any = [];
  months = [
    'janvier',
    'février',
    'mars',
    'avril',
    'mai',
    'juin',
    'juillet',
    'août',
    'septembre',
    'octobre',
    'novembre',
    'décembre'
  ];
  tasks = [];
  timeTable: any = {
    '1' : [],
    '2' : [],
    '3' : [],
    '4' : [],
    '5' : [],
    '6' : [],
    '7' : [],
    '8' : [],
    '9' : [],
    '10' : [],
    '11' : [],
    '12' : [],
    '13' : [],
    '14' : [],
    '15' : [],
    '16' : [],
    '17' : [],
    '18' : [],
    '19' : [],
    '20' : [],
    '21' : [],
    '22' : [],
    '23' : [],
    '24' : [],
    '25' : [],
    '26' : [],
    '27' : [],
    '28' : [],
    '29' : [],
    '30' : [],
  };
  constructor(private router: Router, private httpService: HttpService) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['/login']);
    }
    console.log(this.getTasksDay());
    this.httpService.getTimeTable(this.user.id).subscribe(
      data => {
        for (const c of data['data']) {
          this.timeTable[c['jour']].push(c);
          this.tasks = this.getTasks();
        }
        console.log(this.timeTable);
        console.log((Math.floor(this.getWeekNumber() / 4) - 1) * 5 + this.getDayNumber());
      }, error => {
        console.error(error);
      }
    );
  }

  getDay() {
    return this.days[new Date().getDay()];
  }

  getMonth() {
    return this.months[new Date().getMonth()];
  }

  ngOnInit() {
  }
  getUsagerNames(u) {
    return u.map(e => e.nom + ' ' + e.prenom).join(', ');
  }
  getTasksDay() {
    return (Math.floor(this.getWeekNumber() / 4) - 1) * 5 + this.getDayNumber();
  }
  getTasks() {
    const list = JSON.parse(localStorage.getItem(new Date().getFullYear() + ' ' + this.getWeekNumber() + ' ' + this.getDay()));
    if (list === null) {
      return this.timeTable[this.getTasksDay()];
    }
    const results = [];
    for (const c of this.timeTable[this.getTasksDay()]) {
      if (!list.find(x => x === c.id)) {
        results.push(c);
      }
    }
    return results;
  }
  finish(u) {
    this.selected = u;
    for (const usager of u.usagers) {
        this.selectedUsager.push(usager);
    }
  }
  ajouter() {
    if (this.selected !== null) {
      let list = JSON.parse(localStorage.getItem(new Date().getFullYear() + ' ' + this.getWeekNumber() + ' ' + this.getDay()));
      if (list === null) {
        list = [];
      }
      list.push(this.selected.id);
      localStorage.setItem(new Date().getFullYear() + ' ' + this.getWeekNumber() + ' ' + this.getDay(), JSON.stringify(list));
      this.selected = null;
    }
  }

  getWeekNumber() {
    let d = new Date();
    d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
    d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));
    const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
    const weekNo = Math.ceil(( ( (+d - +yearStart) / 86400000) + 1) / 7);
    return weekNo;
  }
  getDayNumber() {
    return new Date().getDate();
  }


}
