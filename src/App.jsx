import React, { useState } from "react";
import reactLogo from "./assets/react.svg";
import viteLogo from "/vite.svg";
import "./App.css";
import NavBar from "./Components/NavBar";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min";

export const Context = React.createContext();

function App() {
  const [theme, setTheme] = useState("dark");

  return (
    <>
      <Context.Provider value={{ theme, setTheme }}>
        <NavBar />
      </Context.Provider>
    </>
  );
}

export default App;
