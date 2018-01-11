import {Routes} from '@angular/router';
import {ListActivityComponent} from './list-activity/list-activity.component';
import {AddActivityComponent} from './add-activity/add-activity.component';
import {EditActivityComponent} from './edit-activity/edit-activity.component';
import {DeleteActivityComponent} from './delete-activity/delete-activity.component';

export const ACTIVITY_ROUTES: Routes = [
  {path: 'add', component: AddActivityComponent},
  {path: 'edit/:id', component: EditActivityComponent},
  {path: 'delete/:id', component: DeleteActivityComponent},
  {path: 'list', component: ListActivityComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

