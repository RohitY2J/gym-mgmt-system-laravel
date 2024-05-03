import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';

import { DashboardComponent } from './dashboard/dashboard.component';
import { AppComponent } from './app.component';
import { AuthGuard } from './auth/auth.guard';
import { AdminLayoutComponent } from './admin-layout/admin-layout.component';
import { CategoryComponent } from './category/category.component';


const routes: Routes = [
  { path:'', component: LoginComponent},
  { path: 'login', component: LoginComponent},
  {
    path: 'admin', 
    component: AdminLayoutComponent,
    children: [
      { path: '', component: DashboardComponent, outlet: 'admin' },
      { path: 'dashboard', component: DashboardComponent, outlet: 'admin'},
      { path: 'category', component: CategoryComponent, outlet: 'admin' },
      //{ path: 'package-type', compon}
    ],
    canActivate:[AuthGuard]
  },
  //{ path: 'dashboard', component: DashboardComponent, canActivate:[AuthGuard]}
  
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
