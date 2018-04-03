import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {HttpService} from '../../../../Service/HttpService';

@Component({
  selector: 'app-add-category',
  templateUrl: './add-category.component.html',
  styleUrls: ['./add-category.component.scss']
})
export class AddCategoryComponent implements OnInit {
  form: FormGroup;
  user: any;
  users: any = [];
  constructor(private activatedRoute: ActivatedRoute, private router: Router, private httpService: HttpService) {
    this.user = JSON.parse(localStorage.getItem('user'));
    if (this.user === null) {
      this.router.navigate(['/login']);
    }
    this.form = new FormGroup({
        intitule : new FormControl('', Validators.required)
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
      intitule : this.form.controls['intitule'].value,
      centre_id : this.user.centre_id,
    };
    this.httpService.addCategory(u).subscribe(
      data => {
        console.log(data);
        this.goBack();
      }, error => {
        console.error(error);
      }
    );
  }

}
