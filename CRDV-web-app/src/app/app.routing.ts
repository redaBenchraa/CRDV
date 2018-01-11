import {RouterModule, Routes} from '@angular/router';
import {NotFoundComponent} from './not-found/not-found.component';
import {StartComponent} from './start/start.component';
import {AdministrationComponent} from './administration/administration.component';
import {ProfessionalsComponent} from './professional/professionals.component';
import {ADMINISTRATION_ROUTES} from './administration/administartion.routes';
import {PROFESSIONAL_ROUTES} from './professional/professionals.routes';
import {START_ROUTES} from './start/start.routes';
const APP_ROUTES: Routes = [
  {path: 'start', component: StartComponent, children: START_ROUTES},
  {path: 'administration', component: AdministrationComponent, children: ADMINISTRATION_ROUTES},
  {path: 'professional', component: ProfessionalsComponent, children: PROFESSIONAL_ROUTES},
  {path: '', redirectTo: '/start',    pathMatch: 'full'},
  {path: '**', component: NotFoundComponent},
];

export const routing = RouterModule.forRoot(APP_ROUTES);
