import Container from "react-bootstrap/Container";
import Nav from "react-bootstrap/Nav";
import Navbar from "react-bootstrap/Navbar";
import NavDropdown from "react-bootstrap/NavDropdown";
import Form from "react-bootstrap/Form";
import { useContext, useEffect, useState } from "react";
import { Context, ContextConnected } from "../App.tsx";
import LoginModal from "./LoginModal.tsx";
import RegisterModal from "./RegisterModal.tsx";
import {
  setSessionTheme,
  sessionValid,
  sessionLogout,
} from "../Utils/session.tsx";

function LivBar() {
  const State = useContext(Context);
  const StateConnected = useContext(ContextConnected);

  let [loginModal, setLoginModal] = useState(false);
  let [registerModal, setRegisterModal] = useState(false);

  useEffect(() => {
    StateConnected.setter(sessionValid());
  }, []);

  return (
    <>
      <LoginModal show={loginModal} onHide={() => setLoginModal(false)} />
      <RegisterModal
        show={registerModal}
        onHide={() => setRegisterModal(false)}
      />
      <Navbar
        expand="lg"
        className="bg-body-tertiary justify-content-between"
        data-bs-theme={State.value}
      >
        <Container>
          <Navbar.Brand href="">LIV CVL</Navbar.Brand>
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="me-auto">
              <Nav.Link href="">Accueil</Nav.Link>
              <Nav.Link href="">Matchs</Nav.Link>
              {!StateConnected.value ? (
                <>
                  <Nav.Link href="" onClick={() => setLoginModal(true)}>
                    Se Connecter
                  </Nav.Link>
                  <Nav.Link href="" onClick={() => setRegisterModal(true)}>
                    S'inscrire
                  </Nav.Link>
                </>
              ) : (
                <Nav.Link
                  href=""
                  onClick={() => {
                    sessionLogout();
                    StateConnected.setter(false);
                    location.reload();
                  }}
                >
                  Se déconnecter
                </Nav.Link>
              )}
              <NavDropdown title="Mon Compte" id="basic-nav-dropdown">
                <NavDropdown.Item href="">Action</NavDropdown.Item>
                <NavDropdown.Item href="">Another action</NavDropdown.Item>
                <NavDropdown.Item href="#action/3.3">
                  Something
                </NavDropdown.Item>
                <NavDropdown.Divider />
                <NavDropdown.Item href="#action/3.4">
                  Separated link
                </NavDropdown.Item>
              </NavDropdown>
            </Nav>
            <Nav>
              <Form data-bs-theme={State.value}>
                <Form.Check // prettier-ignore
                  data-bs-theme={State.value}
                  type="switch"
                  id="custom-switch"
                  label="Dark Mode"
                  onChange={(e) => {
                    State.setter(e.target.checked ? "dark" : "light");
                    setSessionTheme(e.target.checked ? "dark" : "light");
                  }}
                />
              </Form>
            </Nav>
          </Navbar.Collapse>
        </Container>
      </Navbar>
    </>
  );
}

export default LivBar;
