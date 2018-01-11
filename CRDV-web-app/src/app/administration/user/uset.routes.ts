import {Routes} from '@angular/router';
import {AddUserComponent} from './add-user/add-user.component';
import {EditUserComponent} from './edit-user/edit-user.component';
import {DeleteUserComponent} from './delete-user/delete-user.component';
import {ListUserComponent} from './list-user/list-user.component';


export const USER_ROUTES: Routes = [
  {path: 'add', component: AddUserComponent},
  {path: 'edit/:id', component: EditUserComponent},
  {path: 'delete/:id', component: DeleteUserComponent},
  {path: 'list', component: ListUserComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

