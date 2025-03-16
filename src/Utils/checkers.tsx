import validator from "validator";

export const isEmailValid = (email: string) => {
  if (validator.isEmail(email)) {
    return true;
  } else {
    return false;
  }
};

export const isUsernameValid = (username: string) => {
  const invalidChars = /[!@#$%^&*(),?":{}|<>\-=+]/;
  if (invalidChars.test(username)) {
    return false;
  } else {
    return true;
  }
};

export const isPasswordValid = (password: string) => {
  const hasUpperCase = /[A-Z]/.test(password);
  const hasLowerCase = /[a-z]/.test(password);
  const hasNumber = /[0-9]/.test(password);
  const hasSpecialChar = /[!@#$%^&*(),?":{}|<>\-=+]/.test(password);
  const hasInvalidChars = /[ ]/.test(password);
  const isValidLength = password.length >= 8;

  return (
    hasUpperCase &&
    hasLowerCase &&
    hasNumber &&
    hasSpecialChar &&
    isValidLength &&
    !hasInvalidChars
  );
};
