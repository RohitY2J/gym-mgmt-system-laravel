import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../auth.service'; // Import your AuthService

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.scss'
})
export class LoginComponent implements OnInit {
  loginForm: FormGroup;

  constructor(
    private fb: FormBuilder,
    private authService: AuthService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.loginForm = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required],
      remember: [false]
    });
  }

  onSubmit(): void {
    if (this.loginForm?.valid) {
      const formValues = this.loginForm.value;

      // Call AuthService to authenticate the user
      this.authService.login(formValues).subscribe(
        response => {
          // Handle successful login
          // Redirect user, set user data in a service, or take other appropriate actions
          this.router.navigate(['/dashboard']);
        },
        error => {
          // Handle login error
          console.error('Login failed:', error);
        }
      );
    }
  }
}
