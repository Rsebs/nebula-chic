export interface UserResponse {
  id: number;
  name: string;
  email: string;
  avatarUrl?: string;
}

export const isUserResponse = (data: unknown): data is UserResponse => {
  if (data !== 'object' && data === null) return false;

  const userResponse = data as UserResponse;
  return (
    typeof userResponse.id === 'number' &&
    typeof userResponse.name === 'string' &&
    typeof userResponse.email === 'string'
  );
};
