import { Component, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { CategoryService } from '../service/category/category.service';
import { PackageService } from '../service/package/package.service';
import $ from 'jquery';

@Component({
  selector: 'app-package',
  templateUrl: './package.component.html',
  styleUrl: './package.component.scss'
})
export class PackageComponent {

  @ViewChild('modalRef') modalRef: any;
  packages: any[] = []; // Initialize with the appropriate data type
  packageForm: FormGroup;

  filter = {};

  categories: any[] = []; // Populate with actual data
  periodEnumArr: any[] = [
    { key: '0', value: 'Day' },
    { key: '1', value: 'Month' },
    { key: '2', value: 'Year' }
  ];

  constructor(private fb: FormBuilder, 
    private categoryService: CategoryService, 
    private packageService: PackageService) { }

  ngOnInit(): void {
    this.packageForm = this.fb.group({
      category: ['', Validators.required],
      name: ['', Validators.required],
      price: ['', Validators.required],
      duration: ['', Validators.required],
      period: ['', Validators.required]
    });

    this.categoryService.getCategories().subscribe((data: any) => {
      this.categories = data;
    });

    this.packageService.getPackages(this.filter).subscribe((data: any)=> {
      this.packages = data.packages;
    })
  }
  
  submitForm() {
    if (this.packageForm.valid) {
      // Submit form logic goes here
      this.packageService.addPackage(this.packageForm.value).subscribe((response) => {
        if(response){

          this.packages = response['packages'];
          $('#closeButton').click();
        }
      },(error) => {
        // Handle errors here
        console.error('Error:', error);
      }
    );
    } else {
      // Mark form fields as touched to show validation errors
      this.packageForm.markAllAsTouched();
    }
  }

  deletePackage(id: string): void {
    // Implement deletion logic
    this.packageService.deletePackage(id).subscribe(response=>{
      if(response){
        this.packages = response['packages'];
      }
    },
    error=> {
      
    })
    
  }

  validate(field: string): boolean{
    return this.packageForm.get(field).invalid && (this.packageForm.get(field).touched)
  }
}
