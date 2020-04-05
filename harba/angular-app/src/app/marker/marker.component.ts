import {Component, Inject, OnInit} from '@angular/core';
import {IMarker, IWeather} from "./marker.interface";
import {HarbourService} from "../api/harbour.service";
import {APP_CONFIG, IAppConfig} from "../app.config";

@Component({
  selector: 'app-marker',
  templateUrl: './marker.component.html',
  styleUrls: ['./marker.component.css'],
  providers: [HarbourService]
})
export class MarkerComponent implements OnInit {
  markers: IMarker[];
  imageUlr: string;
  weather: IWeather;

  constructor(private _harbourService: HarbourService, @Inject(APP_CONFIG) private config: IAppConfig) {
    this.imageUlr = config.imageUrl;
  }

  ngOnInit(): void {
    this._harbourService.getHarbours()
      .subscribe(markers => this.markers = markers);
  }

  getInitLatitude(): number {
    return this.markers[0].lat;
  }

  getInitLongitude(): number {
    return this.markers[0].lon;
  }

  showPopup(marker: IMarker) {
    this._harbourService.getWeather(marker.lat, marker.lon)
      .subscribe(weather => marker.weather = weather, error => {});

    marker.showPopup = true;
  }
}

