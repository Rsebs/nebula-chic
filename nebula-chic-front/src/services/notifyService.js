import { Notify } from 'quasar';

export function onShowNotify(sMessage, error = false) {
  return Notify.create({
    message: sMessage,
    position: 'top',
    type: error ? 'negative' : 'positive',
  });
}
