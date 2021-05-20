import { Service } from "./service.model";
import { User } from "./user.model";

export interface Subscription {
    id?: string;
    title: string;
    startDate: Date;
    endDate: Date;
    status: string;
    service:Service;
    subscriber: User 
  
}