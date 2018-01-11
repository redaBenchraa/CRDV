import {Routes} from '@angular/router';
import {AdaptationComponent} from './adaptation/adaptation.component';
import {DailyComponent} from './daily/daily.component';
import {TimetableComponent} from './timetable/timetable.component';
import {NewActivityComponent} from './new-activity/new-activity.component';
import {TIMETABLE_ROUTES} from './timetable/timetable.routes';
import {ADAPTATION_ROUTES} from './adaptation/adaptation.routes';


export const PROFESSIONAL_ROUTES: Routes = [
  {path: 'activity', component: NewActivityComponent},
  {path: 'adaptation', component: AdaptationComponent, children: ADAPTATION_ROUTES},
  {path: 'daily', component: DailyComponent},
  {path: 'timetable', component: TimetableComponent, children: TIMETABLE_ROUTES},
  {path: '', redirectTo: 'daily',    pathMatch: 'full'},
];

