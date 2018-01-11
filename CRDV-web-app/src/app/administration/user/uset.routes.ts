import {Routes} from '@angular/router';
import {ListUserComponent} from './list-User/list-User.component';
import {AddUserComponent} from './add-User/add-User.component';
import {EditUserComponent} from './edit-User/edit-User.component';
import {DeleteUserComponent} from './delete-User/delete-User.component';

export const USER_ROUTES: Routes = [
  {path: 'add', component: AddUserComponent},
  {path: 'edit/:id', component: EditUserComponent},
  {path: 'delete/:id', component: DeleteUserComponent},
  {path: 'list', component: ListUserComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

