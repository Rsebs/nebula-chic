import { Notify } from 'quasar';

export function onShowNotify(sMessage: string, error: boolean = false) {
  return Notify.create({
    message: sMessage,
    position: 'top',
    type: error ? 'negative' : 'positive',
  });
}
