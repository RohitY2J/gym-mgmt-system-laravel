import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, BehaviorSubject  } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private baseUrl = 'http://localhost:8000'; // Replace with your API URL
  private authToken = new BehaviorSubject<string | null>(null);
  authToken$ = this.authToken.asObservable();

  constructor(private http: HttpClient) {}

  login(credentials: any): Observable<boolean> {
    //let email = credentials.email;
    //let password = credentials.password;
    const url = `${this.baseUrl}/api/signIn`;
    //const body = { email, password };
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    return this.http.post<any>(url, credentials, { headers })
      .pipe(
        map(response => {
          if (response && response.token) {
            // Save the token in local storage or session storage
            localStorage.setItem('token', response.token);
            this.authToken.next(response.token);
            return true;
          }
          return false;
        })
      );
  }

  logout(): void {
    // Remove the token from storage
    localStorage.removeItem('authToken');
    this.authToken.next(null);
  }

  getAuthToken(): string | null {
    return localStorage.getItem('authToken');
  }

  isLoggedIn(): boolean {
    return !!this.getAuthToken();
  }
}
