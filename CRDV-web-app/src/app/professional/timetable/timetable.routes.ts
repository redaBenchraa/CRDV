import {Routes} from '@angular/router';
import {ShowTimetableComponent} from './show-Timetable/show-Timetable.component';
import {AddTimetableComponent} from './add-Timetable/add-Timetable.component';
import {EditTimetableComponent} from './edit-Timetable/edit-Timetable.component';
import {DeleteTimetableComponent} from './delete-Timetable/delete-Timetable.component';

export const TIMETABLE_ROUTES: Routes = [
  {path: 'add', component: AddTimetableComponent},
  {path: 'edit/:id', component: EditTimetableComponent},
  {path: 'delete/:id', component: DeleteTimetableComponent},
  {path: 'show', component: ShowTimetableComponent},
  {path: '', redirectTo: 'show',    pathMatch: 'full'},
];

