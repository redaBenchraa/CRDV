import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-add-professional',
  templateUrl: './add-professional.component.html',
  styleUrls: ['./add-professional.component.scss']
})
export class AddProfessionalComponent implements OnInit {
  form: FormGroup;
  user: any;
  constructor(private activatedRoute: ActivatedRoute, private router: Router, private httpService: HttpService) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['/login']);
    }
    this.form = new FormGroup({
        nom : new FormControl('', Validators.required),
        prenom : new FormControl('', Validators.required),
        password : new FormControl('', Validators.required),
        type : new FormControl('', Validators.required),
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
      nom : this.form.controls['nom'].value,
      prenom : this.form.controls['prenom'].value,
      password : this.form.controls['password'].value,
      username : this.form.controls['nom'].value + '.' + this.form.controls['prenom'].value + '.' + this.user.centre_id,
      type : this.form.controls['type'].value,
      centre_id : this.user.centre_id,
    };
    this.httpService.addProffesional(u).subscribe(
      data => {
        console.log(data);
        this.goBack();
      }, error => {
        console.error(error);
      }
    );
  }

}
