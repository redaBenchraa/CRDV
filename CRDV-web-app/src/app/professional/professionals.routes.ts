import {Routes} from '@angular/router';
import {AdaptationComponent} from './adaptation/adaptation.component';
import {DailyComponent} from './daily/daily.component';
import {TimetableComponent} from './timetable/timetable.component';
import {NewActivityComponent} from './new-activity/new-activity.component';


export const PROFESSIONAL_ROUTES: Routes = [
  {path: 'activity', component: NewActivityComponent},
  {path: 'adaptation', component: AdaptationComponent},
  {path: 'daily', component: DailyComponent},
  {path: 'timetable', component: TimetableComponent},
  {path: '', redirectTo: 'daily',    pathMatch: 'full'},
];

