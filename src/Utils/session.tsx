export const sessionValid = () => {
  const token = sessionStorage.getItem("token");
  const id = sessionStorage.getItem("id");
  const user = sessionStorage.getItem("user");
  const email = sessionStorage.getItem("email");
  const theme = sessionStorage.getItem("theme");

  return token !== null && id !== null && user !== null && email !== null;
};

export const sessionLogout = () => {
  sessionStorage.removeItem("token");
  sessionStorage.removeItem("id");
  sessionStorage.removeItem("user");
  sessionStorage.removeItem("email");
  sessionStorage.removeItem("theme");
};

export const startSession = (
  token: string,
  id: string,
  user: string,
  email: string,
  theme: string
) => {
  sessionStorage.setItem("token", token);
  sessionStorage.setItem("id", id);
  sessionStorage.setItem("user", user);
  sessionStorage.setItem("email", email);
  sessionStorage.setItem("theme", theme);
};

export const getSessionToken = () => sessionStorage.getItem("token");
export const getSessionId = () => sessionStorage.getItem("id");
export const getSessionUser = () => sessionStorage.getItem("user");
export const getSessionEmail = () => sessionStorage.getItem("email");
export const getSessionTheme = () => sessionStorage.getItem("theme");

export const setSessionToken = (token: string) =>
  sessionStorage.setItem("token", token);
export const setSessionId = (id: string) => sessionStorage.setItem("id", id);
export const setSessionUser = (user: string) =>
  sessionStorage.setItem("user", user);
export const setSessionEmail = (email: string) =>
  sessionStorage.setItem("email", email);
export const setSessionTheme = (theme: string) =>
  sessionStorage.setItem("theme", theme);
