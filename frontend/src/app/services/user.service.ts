import {HttpClient, HttpParams} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {Observable} from 'rxjs';
import {environment} from 'src/environments/environment';
import {User} from '../models/user.model';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  private hosturlname = environment.hostURL;

  constructor(private http: HttpClient) {
  }

  getUsers(params: any): Observable<User[]> {
    return this.http.get<User[]>(`${this.hosturlname}api/users`, {params});

  }
  
}
