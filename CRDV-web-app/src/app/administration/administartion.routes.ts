import {Routes} from '@angular/router';
import {SerafanComponent} from './serafan/serafan.component';
import {CategoryComponent} from './category/category.component';
import {DashboardComponent} from './dashboard/dashboard.component';
import {StatisticsComponent} from './statistics/statistics.component';
import {SettingsComponent} from './settings/settings.component';
import {UserComponent} from './user/user.component';
import {ProfessionalComponent} from './professional/professional.component';
import {SERAFAN_ROUTES} from './serafan/serafan.routes';
import {CATEGORY_ROUTES} from './category/category.routes';
import {PROFESSIONAL_ROUTES} from './professional/professional.routes';
import {USER_ROUTES} from './user/uset.routes';
import {ProfileComponent} from '../profile/profile.component';
import {Group_ROUTES} from './group/group.routes';
import {GroupComponent} from './group/group.component';
import {ImportComponent} from './import/import.component';

export const ADMINISTRATION_ROUTES: Routes = [
  {path: 'group', component: GroupComponent, children: Group_ROUTES},
  {path: 'serafan', component: SerafanComponent, children: SERAFAN_ROUTES},
  {path: 'category', component: CategoryComponent, children: CATEGORY_ROUTES},
  {path: 'user', component: UserComponent, children: USER_ROUTES},
  {path: 'professional', component: ProfessionalComponent, children: PROFESSIONAL_ROUTES},
  {path: 'dashboard', component: DashboardComponent},
  {path: 'statistics', component: StatisticsComponent},
  {path: 'settings', component: SettingsComponent},
  {path: 'profile', component: ProfileComponent},
  {path: 'import', component: ImportComponent},
  {path: '', redirectTo: 'dashboard',    pathMatch: 'full'},
];

