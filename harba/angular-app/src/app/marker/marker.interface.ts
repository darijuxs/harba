export interface IMarker {
  id: string;
  name: string;
  image?: string;
  lat: number;
  lon: number;
  showPopup: boolean;
  weather: IWeather;
}

export interface IWeather {
  providerName: string;
  temperature: number;
}

