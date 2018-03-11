import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-add-user',
  templateUrl: './add-user.component.html',
  styleUrls: ['./add-user.component.scss']
})
export class AddUserComponent implements OnInit {
  form: FormGroup;
  user: any;
  groups: any = [];
  constructor(private activatedRoute: ActivatedRoute, private router: Router, private httpService: HttpService) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['/login']);
    }
    this.getGroupes();
    this.form = new FormGroup({
      nom : new FormControl('', Validators.required),
      prenom : new FormControl('', Validators.required),
      date_de_naissance : new FormControl('', Validators.required),
      groupe : new FormControl('', Validators.required),
      }
    );
  }
  getGroupes() {
    this.httpService.getGroups(this.user.centre_id, 0).subscribe(
      data => {
        console.log(data);
        this.groups = data['data'];
      }, error2 => {
        console.error(error2);
      }
    );
  }

  ngOnInit() {
  }
  goBack() {
    this.router.navigate(['../list'], {relativeTo: this.activatedRoute});
  }
  insert() {
    const u = {
      date_de_naissance : this.form.controls['date_de_naissance'].value,
      nom : this.form.controls['nom'].value,
      prenom : this.form.controls['prenom'].value,
      groupe_id : this.form.controls['groupe'].value,
      centre_id : this.user.centre_id,
    };
    this.httpService.addUser(u).subscribe(
      data => {
        console.log(data);
        this.goBack();
      }, error => {
        console.error(error);
      }
    );
  }

}
