import React, { useState } from "react";
import LivState from "./classes/LivState";
import Home from "./Pages/Home";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Layout from "./Pages/Layout";
import BetPage from "./Pages/Bet";

export const Context = React.createContext(new LivState(null, () => {}));
export const ContextConnected = React.createContext(
  new LivState(false, () => {})
);

function App() {
  const [theme, setTheme] = useState("dark");
  const [connected, setConnected] = useState(false);

  document.body.setAttribute("data-bs-theme", theme);

  return (
    <ContextConnected.Provider value={new LivState(connected, setConnected)}>
      <Context.Provider value={new LivState(theme, setTheme)}>
        <div data-bs-theme={theme}>
          <BrowserRouter>
            <Routes>
              <Route path="/" element={<Layout />}>
                <Route index element={<Home data-bs-theme={theme} />} />
                <Route path="bet/:matchId" element={<BetPage />} />
                <Route path="*" element={<h1>404</h1>} />
              </Route>
            </Routes>
          </BrowserRouter>
        </div>
      </Context.Provider>
    </ContextConnected.Provider>
  );
}

export default App;
