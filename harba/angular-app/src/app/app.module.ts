import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {AgmCoreModule} from "@agm/core";
import {AppComponent} from './app.component';
import {HttpClientModule} from '@angular/common/http';
import {MarkerComponent} from './marker/marker.component';
import {APP_CONFIG, AppConfig} from './app.config';

@NgModule({
  declarations: [
    AppComponent,
    MarkerComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyDxbSdmuoRMwbwxzt0_jtBcq5rWoSVHpz4'
    })
  ],
  providers: [
    {provide: APP_CONFIG, useValue: AppConfig}
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
