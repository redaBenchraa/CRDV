///<reference path='edit-group/edit-group.component.ts'/>


import {Routes} from '@angular/router';
import {AddGroupComponent} from './add-group/add-group.component';
import {EditGroupComponent} from './edit-group/edit-group.component';
import {DeleteGroupComponent} from './delete-group/delete-group.component';
import {ListGroupComponent} from './list-group/list-group.component';
import {ShowGroupComponent} from './show-group/show-group.component';
export const Group_ROUTES: Routes = [
  {path: 'add', component: AddGroupComponent},
  {path: 'edit/:id', component: EditGroupComponent},
  {path: 'show/:id', component: ShowGroupComponent},
  {path: 'delete/:id', component: DeleteGroupComponent},
  {path: 'list', component: ListGroupComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

