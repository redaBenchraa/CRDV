import {Routes} from '@angular/router';
import {ListCategoryComponent} from './list-Category/list-Category.component';
import {AddCategoryComponent} from './add-Category/add-Category.component';
import {EditCategoryComponent} from './edit-Category/edit-Category.component';
import {DeleteCategoryComponent} from './delete-Category/delete-Category.component';

export const CATEGORY_ROUTES: Routes = [
  {path: 'add', component: AddCategoryComponent},
  {path: 'edit/:id', component: EditCategoryComponent},
  {path: 'delete/:id', component: DeleteCategoryComponent},
  {path: 'list', component: ListCategoryComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

