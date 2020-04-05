import {Inject, Injectable} from '@angular/core';
import {IMarker, IWeather} from "../marker/marker.interface";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {APP_CONFIG, IAppConfig} from "../app.config";

@Injectable()
export class HarbourService {

  constructor(private _http: HttpClient, @Inject(APP_CONFIG) private config: IAppConfig) {
  }

  getHarbours(): Observable<IMarker[]> {
    return this._http.get<IMarker[]>(this.config.apiUrl + '/api/harbours');
  }

  getWeather(lat: number, lon: number): Observable<IWeather> {
    return this._http.post<IWeather>(this.config.apiUrl + '/api/weather', JSON.stringify({latitude: lat, longitude: lon,}));
  }
}
