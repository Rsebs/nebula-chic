import Swal from 'sweetalert2';
import { red, green } from 'vuetify/util/colors';

export const onWarning = async (
  title: string,
  btnConfirmText: string = 'Confirm',
  btnCancelText: string = 'Cancel'
) => {
  try {
    const result = await Swal.fire({
      title,
      showDenyButton: true,
      confirmButtonText: btnConfirmText,
      confirmButtonColor: green.base,
      denyButtonColor: red.base,
      denyButtonText: btnCancelText,
      customClass: {
        container: 'swal-z-index',
      },
    });
    return result;
  } catch (error) {
    console.error(error);
  }
};

export const onSuccess = (title: string, text: string = '') => {
  Swal.fire({
    title,
    text,
    icon: 'success',
    timer: 2500,
    showConfirmButton: false,
    customClass: {
      container: 'swal-z-index',
    },
  });
};

export const onError = (title: string, text: string = '') => {
  Swal.fire({
    title,
    text,
    icon: 'error',
    customClass: {
      container: 'swal-z-index',
    },
  });
};
