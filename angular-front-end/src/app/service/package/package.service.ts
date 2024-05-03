import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../auth/auth.service';

@Injectable({
  providedIn: 'root'
})
export class PackageService {

  private baseUrl = 'http://localhost:8000';

  constructor(private http: HttpClient, private authService: AuthService) {  
  }

  getPackages(filter){
    const header = new HttpHeaders().set('Authorization', `Bearer ${this.authService.getAuthToken()}`);
    return this.http.post(`${this.baseUrl}/api/admin/package/get`,filter,  {headers: header});
  }

  addPackage(packageForm){
    const header = new HttpHeaders().set('Authorization', `Bearer ${this.authService.getAuthToken()}`);
    return this.http.post(`${this.baseUrl}/api/admin/addPackage`, packageForm,  {headers: header});
  }

  deletePackage(id){
    const header = new HttpHeaders().set('Authorization', `Bearer ${this.authService.getAuthToken()}`);
    return this.http.delete(`${this.baseUrl}/api/admin/deletePackage/${id}`,  {headers: header});
  }

  
}
