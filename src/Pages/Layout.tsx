import { Outlet } from "react-router-dom";
import LivBar from "../Components/LivBar";

function Layout() {
  return (
    <>
      <LivBar />
      <Outlet />
    </>
  );
}

export default Layout;
