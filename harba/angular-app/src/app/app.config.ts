import {InjectionToken} from "@angular/core";

export let APP_CONFIG = new InjectionToken("app.config");

export interface IAppConfig {
  apiUrl: string;
  imageUrl: string;
}

export const AppConfig: IAppConfig = {
  apiUrl: "http://harba.local",
  imageUrl: "https://devapi.harba.co"
};
