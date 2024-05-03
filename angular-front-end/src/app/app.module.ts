import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

import { FormsModule } from '@angular/forms';
import { RouterModule, UrlSerializer } from '@angular/router';
import { ReactiveFormsModule } from '@angular/forms';
import { LoginComponent } from './login/login.component';

import { HttpClientModule } from '@angular/common/http';
import { AuthService } from './service/auth/auth.service';
import { DashboardComponent } from './dashboard/dashboard.component';
import { CategoryComponent } from './category/category.component';
import { AdminLayoutComponent } from './admin-layout/admin-layout.component';
import StandardUrlSerializer from './custom-url-serializer';
import { PackageComponent } from './package/package.component';
import { SpinnerComponent } from './spinner/spinner.component';


const customUrlSerializer = new StandardUrlSerializer();

const CustomUrlSerializerProvider = {
  provide: UrlSerializer,
  useValue: customUrlSerializer
};
@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    DashboardComponent,
    CategoryComponent,
    AdminLayoutComponent,
    PackageComponent,
    SpinnerComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    RouterModule,
    HttpClientModule
  ],
  providers: [
    AuthService,
    { provide: UrlSerializer, useClass: StandardUrlSerializer }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
