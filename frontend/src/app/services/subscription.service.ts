import { Injectable } from '@angular/core';
import { AngularFirestore } from '@angular/fire/firestore';
import { map } from 'rxjs/operators';
import { Subscription } from '../models/subscription.model';

@Injectable({
  providedIn: 'root'
})
export class SubscriptionService {

  constructor(private afs: AngularFirestore) { }

  _getAll() {
    return this.afs.collection('hydra:Collection').snapshotChanges().pipe(
      map(actions => actions.map(a => {
        const data = a.payload.doc.data() as Subscription;
        const id = a.payload.doc.id;
        return { id, ...data };
      }))
    );
  }

  save(data: Subscription) {
    return this.afs.collection('hydra:Collection').add(data);
  }

  delete(id: string) {
    return this.afs.collection('hydra:Collection').doc(id).delete();
  }

  getOne(id: string) {
    return this.afs.collection('hydra:Collection').doc(id).valueChanges()
  }

  update(data: Subscription) {
    return this.afs.collection('hydra:Collection').doc(data.id).update(data);
  }
}