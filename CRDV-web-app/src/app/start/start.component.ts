import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";

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
  });
  constructor() { }

  ngOnInit() {
  }

  login() {
    console.log(this.form.controls['username']);
    console.log(this.form.controls['password']);
    console.log(this.form.controls['admin']);
  }

}
