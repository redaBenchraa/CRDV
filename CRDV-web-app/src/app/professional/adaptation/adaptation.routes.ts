import {Routes} from '@angular/router';
import {AddAdaptationComponent} from './add-adaptation/add-adaptation.component';
import {EditAdaptationComponent} from './edit-adaptation/edit-adaptation.component';
import {DeleteAdaptationComponent} from './delete-adaptation/delete-adaptation.component';
import {ListAdaptationComponent} from './list-adaptation/list-adaptation.component';


export const ADAPTATION_ROUTES: Routes = [
  {path: 'add', component: AddAdaptationComponent},
  {path: 'edit/:id', component: EditAdaptationComponent},
  {path: 'delete/:id', component: DeleteAdaptationComponent},
  {path: 'list', component: ListAdaptationComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

