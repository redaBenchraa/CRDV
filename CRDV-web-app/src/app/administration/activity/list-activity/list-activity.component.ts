import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-list-activity',
  templateUrl: './list-activity.component.html',
  styleUrls: ['./list-activity.component.scss']
})
export class ListActivityComponent implements OnInit {
  rows = [
    { name: 'Austin', gender: 'Male', company: 'Swimlane' },
    { name: 'Dany', gender: 'Male', company: 'KFC' },
    { name: 'Molly', gender: 'Female', company: 'Burger King' },
  ];
  columns = [
    { prop: 'name' },
    { name: 'Gender' },
    { name: 'Company' }
  ];
  constructor() { }

  ngOnInit() {
  }

}
