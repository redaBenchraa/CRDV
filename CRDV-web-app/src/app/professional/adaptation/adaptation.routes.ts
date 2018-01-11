import {Routes} from '@angular/router';
import {ListAdaptationComponent} from './list-Adaptation/list-Adaptation.component';
import {AddAdaptationComponent} from './add-Adaptation/add-Adaptation.component';
import {EditAdaptationComponent} from './edit-Adaptation/edit-Adaptation.component';
import {DeleteAdaptationComponent} from './delete-Adaptation/delete-Adaptation.component';

export const ADAPTATION_ROUTES: Routes = [
  {path: 'add', component: AddAdaptationComponent},
  {path: 'edit/:id', component: EditAdaptationComponent},
  {path: 'delete/:id', component: DeleteAdaptationComponent},
  {path: 'list', component: ListAdaptationComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

