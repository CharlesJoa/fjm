import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { FormGroup, FormControl, Validators} from '@angular/forms';
import { FileService } from './file.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  myForm = new FormGroup({
    name: new FormControl('', [Validators.required, Validators.minLength(3)]),
    file: new FormControl('', [Validators.required]),
    fileSource: new FormControl('', [Validators.required])
  });

    constructor(private Fileservice: FileService) { }

  get f(){
    return this.myForm.controls;
  }

  onFileChange(event:any) {

    if (event.target.files.length > 0) {
        const file = event.target.files[0];
        console.log(file)
      this.myForm.patchValue({
        fileSource: file
      });
    }
  }

    submit() {
        this.Fileservice.uploadFile(this.myForm)
        console.log("test")
  }
}
