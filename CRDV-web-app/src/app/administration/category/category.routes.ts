import {Routes} from '@angular/router';
import {AddCategoryComponent} from './add-category/add-category.component';
import {EditCategoryComponent} from './edit-category/edit-category.component';
import {DeleteCategoryComponent} from './delete-category/delete-category.component';
import {ListCategoryComponent} from './list-category/list-category.component';


export const CATEGORY_ROUTES: Routes = [
  {path: 'add', component: AddCategoryComponent},
  {path: 'edit/:id', component: EditCategoryComponent},
  {path: 'delete/:id', component: DeleteCategoryComponent},
  {path: 'list', component: ListCategoryComponent},
  {path: '', redirectTo: 'list',    pathMatch: 'full'},
];

