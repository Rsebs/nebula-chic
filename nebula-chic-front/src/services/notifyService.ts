import { Notify } from 'quasar';

export const onShowNotify = (message: string, error: boolean = false) => {
  return Notify.create({
    message,
    position: 'top',
    type: error ? 'negative' : 'positive',
  });
};

export const onShowNotifyActions = (message: string, actionOk: () => void) => {
  return Notify.create({
    message,
    color: 'warning',
    position: 'top',
    textColor: 'black',
    progress: true,
    timeout: 10000,
    actions: [
      {
        label: 'Eliminar',
        color: 'negative',
        padding: '1',
        flat: false,
        handler: actionOk,
      },
      { label: 'Cancelar' },
    ],
  });
};
