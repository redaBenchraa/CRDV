import {Routes} from '@angular/router';
import {AddCategoryComponent} from './add-category/add-category.component';
import {EditCategoryComponent} from './edit-category/edit-category.component';
import {DeleteCategoryComponent} from './delete-category/delete-category.component';
import {ListCategoryComponent} from './list-category/list-category.component';
import {ActivityComponent} from './activity/activity.component';
import {ACTIVITY_ROUTES} from './activity/activity.routes';


export const CATEGORY_ROUTES: Routes = [
  {path: 'add', component: AddCategoryComponent},
  {path: 'edit/:id', component: EditCategoryComponent},
  {path: 'activites', component: ActivityComponent, children : ACTIVITY_ROUTES},
  {path: 'delete/:id', component: DeleteCategoryComponent},
  {path: 'list', component: ListCategoryComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

