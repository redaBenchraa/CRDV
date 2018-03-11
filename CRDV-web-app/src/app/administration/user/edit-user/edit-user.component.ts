import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-edit-user',
  templateUrl: './edit-user.component.html',
  styleUrls: ['./edit-user.component.scss']
})
export class EditUserComponent implements OnInit {
  form: FormGroup;
  admin: any;
  user: any;
  groups: any = [];
  constructor(private route: ActivatedRoute, private router: Router, private httpService: HttpService) {
    this.admin = JSON.parse(localStorage.getItem('user'));
    if (this.admin === null) {
      this.router.navigate(['/login']);
    }
    this.form = new FormGroup({
        nom : new FormControl('', Validators.required),
        prenom : new FormControl('', Validators.required),
        date_de_naissance : new FormControl('', Validators.required),
        groupe : new FormControl('', Validators.required),
      }
    );
    this.getGroupes();
  }
  getUser(id) {
    this.httpService.getUser(id).subscribe(
      data => {
        console.log(data);
        this.user = data['data'];
        this.form.controls['nom'].patchValue(this.user.nom);
        this.form.controls['prenom'].patchValue(this.user.prenom);
        this.form.controls['date_de_naissance'].patchValue(this.user.date_de_naissance.split(' ')[0]);
        this.form.controls['groupe'].patchValue(this.user.groupe_id);
      }, error => {
        console.log(error);
      }
    );
  }
  getGroupes() {
    this.httpService.getGroups(this.admin.centre_id, 0).subscribe(
      data => {
        console.log(data);
        this.groups = data['data'];
      }, error2 => {
        console.error(error2);
      }
    );
  }

  ngOnInit() {
    this.route.paramMap.subscribe(params => {
      this.getUser(params.get('id'));
    });
  }
  goBack() {
    this.router.navigate(['../../list'], {relativeTo: this.route});
  }
  insert() {
    const u = {
      date_de_naissance : this.form.controls['date_de_naissance'].value,
      nom : this.form.controls['nom'].value,
      prenom : this.form.controls['prenom'].value,
      groupe_id : this.form.controls['groupe'].value,
      centre_id : this.user.centre_id,
    };
    this.httpService.updateUser(this.user.id, u).subscribe(
      data => {
        console.log(data);
        this.goBack();
      }, error => {
        console.error(error);
      }
    );
  }

}
