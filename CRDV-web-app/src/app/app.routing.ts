import {RouterModule, Routes} from '@angular/router';
import {NotFoundComponent} from './not-found/not-found.component';
import {StartComponent} from './start/start.component';
import {AdministrationComponent} from './administration/administration.component';
import {ProfessionalsComponent} from './professional/professionals.component';
import {ADMINISTRATION_ROUTES} from './administration/administartion.routes';
import {PROFESSIONAL_ROUTES} from './professional/professionals.routes';
import {START_ROUTES} from './start/start.routes';
import {AuthGuard} from "../Service/AuthGuard";
import {LoginGuard} from "../Service/LoginGuard";
const APP_ROUTES: Routes = [
  {path: 'start', component: StartComponent, children: START_ROUTES, canActivate: [LoginGuard]},
  {path: 'login', component: StartComponent, children: START_ROUTES, canActivate: [LoginGuard]},
  {path: 'administration', component: AdministrationComponent, children: ADMINISTRATION_ROUTES, canActivate: [AuthGuard]},
  {path: 'professional', component: ProfessionalsComponent, children: PROFESSIONAL_ROUTES, canActivate: [AuthGuard]},
  {path: '', redirectTo: '/start',    pathMatch: 'full'},
  {path: '**', component: NotFoundComponent},
];

export const routing = RouterModule.forRoot(APP_ROUTES);
