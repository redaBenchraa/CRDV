import { Component } from '@angular/core';
import { Location } from '@angular/common';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss']
})
export class ProfileComponent  {
  // inject location into component constructor
  constructor(private location: Location) { }

  goBack() {
    this.location.back(); // <-- go back to previous location on cancel
  }

}
