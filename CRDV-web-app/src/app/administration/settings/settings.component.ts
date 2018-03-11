import { Component, OnInit } from '@angular/core';
import {HttpService} from '../../../Service/HttpService';
import {Router} from '@angular/router';

@Component({
  selector: 'app-settings',
  templateUrl: './settings.component.html',
  styleUrls: ['./settings.component.scss']
})
export class SettingsComponent implements OnInit {
  params = [45, 30];
  user: any;
  constructor(private router: Router, private httpService: HttpService) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['login']);
    }
    this.httpService.getParams(this.user.centre_id).subscribe(
      data => {
        for (const c of data['data']) {
          if (c['nom'] === 'directe') {
             this.params[0] = c['valeur'];
          }
          if (c['nom'] === 'indirecte') {
            this.params[1] = c['valeur'];
          }
        }
        console.log(data);
      }, error => {
        console.error(error);
      }
    );
  }

  ngOnInit() {
  }

  saveParams() {
    const param =  {directe: this.params[0], indirecte: this.params[1]};
    console.log(param);
    this.httpService.updateParams(this.user.centre_id, param).subscribe(
      data => {
        console.log(data);
      }, error => {
        console.log(error);
      }
    )
  }

}
