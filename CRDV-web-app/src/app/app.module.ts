import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';


import { AppComponent } from './app.component';
import {FontAwesomeModule, ThemifyModule} from 'ngx-icons';
import { HeaderComponent } from './layers/header/header.component';
import { SidebarComponent } from './layers/sidebar/sidebar.component';
import { FooterComponent } from './layers/footer/footer.component';
import { DashboardComponent } from './administration/dashboard/dashboard.component';
import { ProfessionalComponent } from './administration/professional/professional.component';
import { UserComponent } from './administration/user/user.component';
import { ActivityComponent } from './administration/activity/activity.component';
import { SettingsComponent } from './administration/settings/settings.component';
import { CategoryComponent } from './administration/category/category.component';
import { StatisticsComponent } from './administration/statistics/statistics.component';
import { DailyComponent } from './professional/daily/daily.component';
import { TimetableComponent } from './professional/timetable/timetable.component';
import { AdaptationComponent } from './professional/adaptation/adaptation.component';
import { LoginComponent } from './start/login/login.component';
import { StartComponent } from './start/start.component';
import { NotFoundComponent } from './not-found/not-found.component';
import { AdministrationComponent } from './administration/administration.component';
import {routing} from './app.routing';
import {ProfessionalsComponent} from './professional/professionals.component';
import { NewActivityComponent } from './professional/new-activity/new-activity.component';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    SidebarComponent,
    FooterComponent,
    DashboardComponent,
    ProfessionalComponent,
    ProfessionalsComponent,
    UserComponent,
    ActivityComponent,
    SettingsComponent,
    CategoryComponent,
    StatisticsComponent,
    DailyComponent,
    TimetableComponent,
    AdaptationComponent,
    LoginComponent,
    StartComponent,
    NotFoundComponent,
    AdministrationComponent,
    NewActivityComponent,
  ],
  imports: [
    BrowserModule,
    FontAwesomeModule,
    ThemifyModule,
    routing
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
