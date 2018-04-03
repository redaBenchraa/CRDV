import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-edit-professional',
  templateUrl: './edit-professional.component.html',
  styleUrls: ['./edit-professional.component.scss']
})
export class EditProfessionalComponent implements OnInit {
  form: FormGroup;
  admin: any;
  professional: any;
  groups: any = [];
  constructor(private route: ActivatedRoute, private router: Router, private httpService: HttpService) {
    this.admin = JSON.parse(localStorage.getItem('user'));
    if (this.admin === null) {
      this.router.navigate(['/login']);
    }
    this.form = new FormGroup({
      type : new FormControl('', Validators.required),
      nom : new FormControl('', Validators.required),
      prenom : new FormControl('', Validators.required),
      }
    );
    this.getGroupes();
  }
  getProfessional(id) {
    this.httpService.getProfessional(id).subscribe(
      data => {
        console.log(data);
        this.professional = data['data'];
        this.form.controls['type'].patchValue(this.professional.type);
        this.form.controls['nom'].patchValue(this.professional.nom);
        this.form.controls['prenom'].patchValue(this.professional.prenom);
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
      this.getProfessional(params.get('id'));
    });
  }
  goBack() {
    this.router.navigate(['../../list'], {relativeTo: this.route});
  }
  insert() {
    const u = {
      nom : this.form.controls['nom'].value,
      prenom : this.form.controls['prenom'].value,
      username : this.form.controls['nom'].value + '.' + this.form.controls['prenom'].value + '.' + this.admin.centre_id,
      type : this.form.controls['type'].value,
    };
    this.httpService.updateProffesional(this.professional.id, u).subscribe(
      data => {
        console.log(data);
        this.goBack();
      }, error => {
        console.error(error);
      }
    );
  }

}
