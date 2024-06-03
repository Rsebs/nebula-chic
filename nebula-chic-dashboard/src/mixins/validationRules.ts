const stringFieldRequired = 'This field is required';

export const fieldRequired = (v: unknown): boolean | string =>
  !!v || stringFieldRequired;
