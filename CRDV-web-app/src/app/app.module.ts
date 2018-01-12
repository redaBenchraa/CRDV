import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';


import { AppComponent } from './app.component';
import {FontAwesomeModule, ThemifyModule} from 'ngx-icons';
import { HeaderComponent } from './layers/header/header.component';
import { SidebarComponent } from './administration/sidebar/sidebar.component';
import { SidebarProfessionalComponent } from './professional/sidebar/sidebar.component';
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
import { ListActivityComponent } from './administration/activity/list-activity/list-activity.component';
import { AddActivityComponent } from './administration/activity/add-activity/add-activity.component';
import { DeleteActivityComponent } from './administration/activity/delete-activity/delete-activity.component';
import { EditActivityComponent } from './administration/activity/edit-activity/edit-activity.component';
import { ListCategoryComponent } from './administration/category/list-category/list-category.component';
import { AddCategoryComponent } from './administration/category/add-category/add-category.component';
import { DeleteCategoryComponent } from './administration/category/delete-category/delete-category.component';
import { EditCategoryComponent } from './administration/category/edit-category/edit-category.component';
import { ListProfessionalComponent } from './administration/professional/list-professional/list-professional.component';
import { AddProfessionalComponent } from './administration/professional/add-professional/add-professional.component';
import { EditProfessionalComponent } from './administration/professional/edit-professional/edit-professional.component';
import { DeleteProfessionalComponent } from './administration/professional/delete-professional/delete-professional.component';
import { ListUserComponent } from './administration/user/list-user/list-user.component';
import { AddUserComponent } from './administration/user/add-user/add-user.component';
import { EditUserComponent } from './administration/user/edit-user/edit-user.component';
import { DeleteUserComponent } from './administration/user/delete-user/delete-user.component';
import { ListAdaptationComponent } from './professional/adaptation/list-adaptation/list-adaptation.component';
import { AddAdaptationComponent } from './professional/adaptation/add-adaptation/add-adaptation.component';
import { EditAdaptationComponent } from './professional/adaptation/edit-adaptation/edit-adaptation.component';
import { DeleteAdaptationComponent } from './professional/adaptation/delete-adaptation/delete-adaptation.component';
import { AddTimetableComponent } from './professional/timetable/add-timetable/add-timetable.component';
import { DeleteTimetableComponent } from './professional/timetable/delete-timetable/delete-timetable.component';
import { EditTimetableComponent } from './professional/timetable/edit-timetable/edit-timetable.component';
import { ShowTimetableComponent } from './professional/timetable/show-timetable/show-timetable.component';
import {NgxDatatableModule} from '@swimlane/ngx-datatable';
import { PasswordComponent } from './administration/professional/password/password.component';
import { ProfileComponent } from './profile/profile.component';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    SidebarComponent,
    SidebarProfessionalComponent,
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
    ListActivityComponent,
    AddActivityComponent,
    DeleteActivityComponent,
    EditActivityComponent,
    ListCategoryComponent,
    AddCategoryComponent,
    DeleteCategoryComponent,
    EditCategoryComponent,
    ListProfessionalComponent,
    AddProfessionalComponent,
    EditProfessionalComponent,
    DeleteProfessionalComponent,
    ListUserComponent,
    AddUserComponent,
    EditUserComponent,
    DeleteUserComponent,
    ListAdaptationComponent,
    AddAdaptationComponent,
    EditAdaptationComponent,
    DeleteAdaptationComponent,
    AddTimetableComponent,
    DeleteTimetableComponent,
    EditTimetableComponent,
    ShowTimetableComponent,
    PasswordComponent,
    ProfileComponent,
  ],
  imports: [
    BrowserModule,
    FontAwesomeModule,
    ThemifyModule,
    routing,
    NgxDatatableModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
