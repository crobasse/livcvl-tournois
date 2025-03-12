import React, { Suspense, useEffect, useState } from "react";
import LivBar from "./Components/LivBar";
import LivState from "./classes/LivState";
import Home from "./Pages/Home";
import DataFetcher from "./Components/DataFetcher";

export const Context = React.createContext(new LivState(null, () => {}));

function App() {
  const [theme, setTheme] = useState("light");

  return (
    <Context.Provider value={new LivState(theme, setTheme)}>
      <LivBar />
      <Home data-bs-theme={theme} />
    </Context.Provider>
  );
}

export default App;
