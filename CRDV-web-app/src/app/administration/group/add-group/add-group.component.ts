import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-add-group',
  templateUrl: './add-group.component.html',
  styleUrls: ['./add-group.component.scss']
})
export class AddGroupComponent implements OnInit {
  form: FormGroup;
  user: any;
  users: any = [];
  constructor(private activatedRoute: ActivatedRoute, private router: Router, private httpService: HttpService) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['/login']);
    }
    this.getUsers();
    this.form = new FormGroup({
        nom : new FormControl('', Validators.required),
      }
    );
  }

  ngOnInit() {
  }
  goBack() {
    this.router.navigate(['../list'], {relativeTo: this.activatedRoute});
  }
  getUsers() {
    this.httpService.getUsers(this.users.centre_id, 0).subscribe(
      data => {
        console.log(data);
        this.users = data['data'];
      }, error => {
        console.error(error);
      }
    );
  }
  insert() {
    const u = {
      nom : this.form.controls['nom'].value,
      centre_id : this.user.centre_id,
    };
    this.httpService.addGroup(u).subscribe(
      data => {
        console.log(data);
        this.goBack();
      }, error => {
        console.error(error);
      }
    );
  }

}
