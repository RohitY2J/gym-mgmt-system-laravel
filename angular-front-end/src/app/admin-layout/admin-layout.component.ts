import { Component } from '@angular/core';
import { LoadingService } from '../service/helper/loading.service';

@Component({
  selector: 'app-admin-layout',
  templateUrl: './admin-layout.component.html',
  styleUrl: './admin-layout.component.scss'
})
export class AdminLayoutComponent {

  constructor(public loadingService: LoadingService){

  }


  handleClick(param: any) {
    console.log('Clicked with parameter:', param);
  }

}
