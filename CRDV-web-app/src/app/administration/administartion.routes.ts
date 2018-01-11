import {Routes} from '@angular/router';
import {ActivityComponent} from './activity/activity.component';
import {CategoryComponent} from './category/category.component';
import {DashboardComponent} from './dashboard/dashboard.component';
import {StatisticsComponent} from './statistics/statistics.component';
import {SettingsComponent} from './settings/settings.component';
import {UserComponent} from './user/user.component';
import {ProfessionalComponent} from './professional/professional.component';
import {ACTIVITY_ROUTES} from './activity/activity.routes';
import {CATEGORY_ROUTES} from './category/category.routes';
import {PROFESSIONAL_ROUTES} from './professional/professional.routes';

export const ADMINISTRATION_ROUTES: Routes = [
  {path: 'activity', component: ActivityComponent, children: ACTIVITY_ROUTES},
  {path: 'category', component: CategoryComponent, children: CATEGORY_ROUTES},
  {path: 'user', component: UserComponent, children: ACTIVITY_ROUTES},
  {path: 'professional', component: ProfessionalComponent, children: PROFESSIONAL_ROUTES},
  {path: 'dashboard', component: DashboardComponent},
  {path: 'statistics', component: StatisticsComponent},
  {path: 'settings', component: SettingsComponent},
  {path: '', redirectTo: 'dashboard',    pathMatch: 'full'},
];

