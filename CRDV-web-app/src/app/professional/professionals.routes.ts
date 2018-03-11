import {Routes} from '@angular/router';
import {AdaptationComponent} from './adaptation/adaptation.component';
import {DailyComponent} from './daily/daily.component';
import {TimetableComponent} from './timetable/timetable.component';
import {NewActivityComponent} from './new-activity/new-activity.component';
import {TIMETABLE_ROUTES} from './timetable/timetable.routes';
import {ADAPTATION_ROUTES} from './adaptation/adaptation.routes';
import {ProfileComponent} from '../profile/profile.component';
import {ValidateComponent} from "./validate/validate.component";


export const PROFESSIONAL_ROUTES: Routes = [
  {path: 'activity', component: NewActivityComponent},
  {path: 'validate', component: ValidateComponent},
  // {path: 'adaptation', component: AdaptationComponent, children: ADAPTATION_ROUTES},
  {path: 'daily', component: DailyComponent},
  {path: 'timetable', component: TimetableComponent, children: TIMETABLE_ROUTES},
  {path: 'profile', component: ProfileComponent},
  {path: '', redirectTo: 'daily',    pathMatch: 'full'},
];

