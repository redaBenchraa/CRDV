import {Routes} from '@angular/router';
import {ActivityComponent} from './activity/activity.component';
import {CategoryComponent} from './category/category.component';
import {DashboardComponent} from './dashboard/dashboard.component';
import {StatisticsComponent} from './statistics/statistics.component';
import {SettingsComponent} from './settings/settings.component';
import {UserComponent} from './user/user.component';
import {ProfessionalComponent} from './professional/professional.component';

export const ADMINISTRATION_ROUTES: Routes = [
  {path: 'activity', component: ActivityComponent},
  {path: 'category', component: CategoryComponent},
  {path: 'dashboard', component: DashboardComponent},
  {path: 'statistics', component: StatisticsComponent},
  {path: 'settings', component: SettingsComponent},
  {path: 'professional', component: ProfessionalComponent},
  {path: 'user', component: UserComponent},
  {path: '', redirectTo: 'dashboard',    pathMatch: 'full'},
];

