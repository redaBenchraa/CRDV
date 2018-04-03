import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-edit-category',
  templateUrl: './edit-category.component.html',
  styleUrls: ['./edit-category.component.scss']
})
export class EditCategoryComponent implements OnInit {
  form: FormGroup;
  admin: any;
  category: any;
  constructor(private route: ActivatedRoute, private router: Router, private httpService: HttpService) {
    this.admin = JSON.parse(localStorage.getItem('user'));
    if (this.admin === null) {
      this.router.navigate(['/login']);
    }
    this.form = new FormGroup({
        code : new FormControl('', Validators.required),
        intitule : new FormControl('', Validators.required)
      }
    );

  }
  getCategory(id) {
    this.httpService.getSerafin(id).subscribe(
      data => {
        console.log(data);
        this.category = data['data'];
        this.form.controls['code'].patchValue(this.category.code);
        this.form.controls['intitule'].patchValue(this.category.intitule);
      }, error => {
        console.log(error);
      }
    );
  }

  ngOnInit() {
    this.route.paramMap.subscribe(params => {
      this.getCategory(params.get('id'));
    });
  }
  goBack() {
    this.router.navigate(['../../list'], {relativeTo: this.route});
  }
  insert() {
    const u = {
      intitule : this.form.controls['intitule'].value,
      centre_id : this.admin.centre_id,
    };
    this.httpService.updateCategory(this.category.id, u).subscribe(
      data => {
        console.log(data);
        this.goBack();
      }, error => {
        console.error(error);
      }
    );
  }

}
