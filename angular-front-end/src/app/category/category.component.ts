import { Component } from '@angular/core';
import { CategoryService } from '../service/category/category.service';
import { LoadingService } from '../service/helper/loading.service';

@Component({
  selector: 'app-category',
  templateUrl: './category.component.html',
  styleUrl: './category.component.scss'
})
export class CategoryComponent {

  categories: any[] = [];
  newCategory: any = {};
  successMessage: string = '';

  constructor(
    private categoryService: CategoryService,
    private loadingService: LoadingService
  ) { } // Inject your category service here

  ngOnInit(): void {
    this.loadCategories();
  }

  loadCategories() {
    // Call your category service to fetch categories
    this.loadingService.setLoadingState(true);
    this.categoryService.getCategories().subscribe((data: any) => {
      this.categories = data;
      this.loadingService.setLoadingState(false);
    });
  }

  addCategory() {
    // Call your category service to add a new category
    this.categoryService.addCategory(this.newCategory).subscribe(() => {
      this.successMessage = 'Category added successfully.';
      this.newCategory = {}; // Clear the input field after adding category
      this.loadCategories(); // Refresh the categories list
    });
  }

  deleteCategory(categoryId: number) {
    // Call your category service to delete the category
    this.loadingService.setLoadingState(false);

    this.categoryService.deleteCategory(categoryId).subscribe(() => {
      this.successMessage = 'Category deleted successfully.';
      this.loadingService.setLoadingState(false);
      this.loadCategories(); // Refresh the categories list
    });
  }
}
