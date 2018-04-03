import { Component } from '@angular/core';
import { Location } from '@angular/common';
import {Router} from '@angular/router';
import {HttpService} from '../../Service/HttpService';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss']
})
export class ProfileComponent  {
  user: any;
  password: string;
  old_password: string;
  repassword: string;
  constructor(private location: Location, private router: Router, private httpService: HttpService) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['/start']);
    }
  }
  update() {
    console.log(this.user);
    this.httpService.updatePro(this.user.id, {nom: this.user.nom, prenom: this.user.prenom}).subscribe(
      data => {
        localStorage.setItem('user', JSON.stringify(data['data']));
      }
    );
  }
  changePassword() {
    this.httpService.changePassword({id: this.user.id, old_password: this.old_password, password: this.password}).subscribe(
      data => {
        console.log(data);
      }
    );
  }
  goBack() {
    this.location.back(); // <-- go back to previous location on cancel
  }

}
