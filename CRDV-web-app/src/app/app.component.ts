import {AfterViewInit, Component} from '@angular/core';
import * as $ from 'jquery';
import 'jquery-sparkline';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements AfterViewInit {
  loaded = false;
  constructor() {

  }
  ngAfterViewInit() {
    this.loaded = true;
  }
}
