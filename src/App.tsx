import React, { useState } from "react";
import LivBar from "./Components/LivBar";
import LivState from "./classes/LivState";
import Home from "./Pages/Home";

export const Context = React.createContext(new LivState(null, () => {}));

function App() {
  const [theme, setTheme] = useState("light");

  document.body.setAttribute("data-bs-theme", theme);

  return (
    <Context.Provider value={new LivState(theme, setTheme)}>
      <div data-bs-theme={theme}>
        <LivBar />
        <Home data-bs-theme={theme} />
      </div>
    </Context.Provider>
  );
}

export default App;
