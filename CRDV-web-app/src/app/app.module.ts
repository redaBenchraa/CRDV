import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';


import { AppComponent } from './app.component';
import {FontAwesomeModule, ThemifyModule} from 'ngx-icons';


@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    FontAwesomeModule,
    ThemifyModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
