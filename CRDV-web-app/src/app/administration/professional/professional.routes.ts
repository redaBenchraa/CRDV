import {Routes} from '@angular/router';
import {ListProfessionalComponent} from './list-Professional/list-Professional.component';
import {AddProfessionalComponent} from './add-Professional/add-Professional.component';
import {EditProfessionalComponent} from './edit-Professional/edit-Professional.component';
import {DeleteProfessionalComponent} from './delete-Professional/delete-Professional.component';

export const PROFESSIONAL_ROUTES: Routes = [
  {path: 'add', component: AddProfessionalComponent},
  {path: 'edit/:id', component: EditProfessionalComponent},
  {path: 'delete/:id', component: DeleteProfessionalComponent},
  {path: 'list', component: ListProfessionalComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

