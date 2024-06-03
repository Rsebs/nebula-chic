type ComponentType =
  | 'InputDate'
  | 'InputFile'
  | 'InputMultiFile'
  | 'InputMultiSelect'
  | 'InputNumber'
  | 'InputPassword'
  | 'InputSelect'
  | 'InputStatus'
  | 'InputText'
  | 'InputTextarea'
  | 'InputTime';

export interface Fields {
  component: ComponentType;
  label: string;
  nameKey: string;
  endpointSelect?: string;
  required?: boolean;
}

export type FunctionValidation = (v: unknown) => boolean | string;
