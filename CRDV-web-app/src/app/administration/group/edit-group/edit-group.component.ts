import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-edit-group',
  templateUrl: './edit-group.component.html',
  styleUrls: ['./edit-group.component.scss']
})
export class EditGroupComponent implements OnInit {
  form: FormGroup;
  admin: any;
  group: any;
  groups: any = [];
  constructor(private route: ActivatedRoute, private router: Router, private httpService: HttpService) {
    this.admin = JSON.parse(localStorage.getItem('user'));
    if (this.admin === null) {
      this.router.navigate(['/login']);
    }
    this.form = new FormGroup({
        nom : new FormControl('', Validators.required),
      }
    );

  }
  getGroup(id) {
    this.httpService.getGroup(id).subscribe(
      data => {
        console.log(data);
        this.group = data['data'];
        this.form.controls['nom'].patchValue(this.group.nom);
      }, error => {
        console.log(error);
      }
    );
  }

  ngOnInit() {
    this.route.paramMap.subscribe(params => {
      this.getGroup(params.get('id'));
    });
  }
  goBack() {
    this.router.navigate(['../../list'], {relativeTo: this.route});
  }
  insert() {
    const u = {
      nom : this.form.controls['nom'].value,
      centre_id : this.group.centre_id,
    };
    this.httpService.updateGroup(this.group.id, u).subscribe(
      data => {
        console.log(data);
        this.goBack();
      }, error => {
        console.error(error);
      }
    );
  }

}
