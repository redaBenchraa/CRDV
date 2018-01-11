import {Routes} from '@angular/router';
import {AddTimetableComponent} from './add-timetable/add-timetable.component';
import {EditTimetableComponent} from './edit-timetable/edit-timetable.component';
import {DeleteTimetableComponent} from './delete-timetable/delete-timetable.component';
import {ShowTimetableComponent} from './show-timetable/show-timetable.component';


export const TIMETABLE_ROUTES: Routes = [
  {path: 'add', component: AddTimetableComponent},
  {path: 'edit/:id', component: EditTimetableComponent},
  {path: 'delete/:id', component: DeleteTimetableComponent},
  {path: 'show', component: ShowTimetableComponent},
  {path: '', redirectTo: 'show',    pathMatch: 'full'},
];

