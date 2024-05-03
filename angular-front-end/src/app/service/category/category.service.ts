import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../auth/auth.service';


@Injectable({
  providedIn: 'root'
})
export class CategoryService {

  private baseUrl = 'http://localhost:8000';

  constructor(private http: HttpClient, private authService: AuthService) {  
  }

  getCategories() {
    const header = new HttpHeaders().set('Authorization', `Bearer ${this.authService.getAuthToken()}`);
    return this.http.get(`${this.baseUrl}/api/admin/getCategory`, {headers: header});
  }

  addCategory(category: any) {
    const header = new HttpHeaders().set('Authorization', `Bearer ${this.authService.getAuthToken()}`);
    return this.http.post(`${this.baseUrl}/api/admin/category/add`, category, {headers: header});
  }

  deleteCategory(categoryId: number) {
    const header = new HttpHeaders().set('Authorization', `Bearer ${this.authService.getAuthToken()}`);
    return this.http.delete(`${this.baseUrl}/api/admin/category/delete/${categoryId}`, {headers: header});
  }

}
