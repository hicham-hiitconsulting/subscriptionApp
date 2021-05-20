import { Subscription } from "./subscription.model";

export interface Service {
    id?: string;
    name: string;
    subscriptions: Subscription;
    url: string;
    price: string;
  
}