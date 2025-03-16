import React, { useState } from "react";
import LivBar from "./Components/LivBar";
import LivState from "./classes/LivState";
import Home from "./Pages/Home";

export const Context = React.createContext(new LivState(null, () => {}));
export const ContextConnected = React.createContext(
  new LivState(false, () => {})
);

function App() {
  const [theme, setTheme] = useState("light");
  const [connected, setConnected] = useState(false);

  document.body.setAttribute("data-bs-theme", theme);

  return (
    <ContextConnected.Provider value={new LivState(connected, setConnected)}>
      <Context.Provider value={new LivState(theme, setTheme)}>
        <div data-bs-theme={theme}>
          <LivBar />
          <Home data-bs-theme={theme} />
        </div>
      </Context.Provider>
    </ContextConnected.Provider>
  );
}

export default App;
