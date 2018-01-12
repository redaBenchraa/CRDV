import {Routes} from '@angular/router';
import {AddProfessionalComponent} from './add-professional/add-professional.component';
import {EditProfessionalComponent} from './edit-professional/edit-professional.component';
import {DeleteProfessionalComponent} from './delete-professional/delete-professional.component';
import {ListProfessionalComponent} from './list-professional/list-professional.component';
import {PasswordComponent} from './password/password.component';


export const PROFESSIONAL_ROUTES: Routes = [
  {path: 'add', component: AddProfessionalComponent},
  {path: 'edit/:id', component: EditProfessionalComponent},
  {path: 'delete/:id', component: DeleteProfessionalComponent},
  {path: 'password/:id', component: PasswordComponent},
  {path: 'list', component: ListProfessionalComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

