import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {HttpService} from '../../Service/HttpService';
import {Router} from "@angular/router";

@Component({
  selector: 'app-start',
  templateUrl: './start.component.html',
  styleUrls: ['./start.component.scss']
})
export class StartComponent implements OnInit {
  form = new FormGroup({
    username: new FormControl(),
    password: new FormControl(),
    admin: new FormControl(),
    centre: new FormControl(),
  });
  centres = [];
  constructor(private router: Router, private httpService: HttpService) {
    this.getCentres();
  }

  ngOnInit() {
  }

  getCentres() {
    this.httpService.getCentres().subscribe(
      data => {
        console.log(data);
        this.centres = data['data']['data'];
        console.log(this.centres);

      }, error => {
        console.log(error);
      }
    );
  }
  login() {
    const c = {
      username : this.form.controls['username'].value + '.' + this.form.controls['centre'].value,
      password : this.form.controls['password'].value
    };
    console.log(c);
    if (this.form.controls['admin'].value === true) {
       this.httpService.loginAdmin(c).subscribe(
        data => {
          this.save(data, 1);
        }, error => {
          console.error(error);
        }
      );
    }else {
       this.httpService.loginPro(c).subscribe(
        data => {
          console.log(data);
          this.save(data, 0);
        }, error => {
          console.error(error);
        }
      );
    }
  }
  save(data, type) {
    localStorage.setItem('token', JSON.stringify(data));
    this.httpService.getMe().subscribe(
      dat => {
        if (type === 1) {
          if (dat['type'] === type) {
            localStorage.setItem('user', JSON.stringify(dat));
            this.router.navigate(['administration']);
          }else {
            console.error('you are not admin');
            localStorage.removeItem('token');
          }
        }else {
          localStorage.setItem('user', JSON.stringify(dat));
          this.router.navigate(['professional']);
        }
      }, error => {
        console.error(data);
      }
    );
  }


}
