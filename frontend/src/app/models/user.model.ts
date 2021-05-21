import {Subscription} from "./subscription.model";

export interface User {
  id?: string;
  email: string;
  password: string;
  roles: Date;
  firstname: string;
  lastname: string;
  phone: string;
  subscriptions: Subscription

}
