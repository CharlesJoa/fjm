import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class FileService {
    
    constructor(private http: HttpClient) { }
    uploadFile(form: any) {
        let input = new FormData();
        input.append("file", form.value.file);
        input.append("FileName", form.value.fileName);
        return this.http.post( "https://b24-tdwgxe.bitrix24.fr/rest/26/u2n2x176xred0jya/upload.json", input).subscribe();
    }
}
