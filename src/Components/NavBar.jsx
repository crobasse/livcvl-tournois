import Container from "react-bootstrap/Container";
import Nav from "react-bootstrap/Nav";
import Navbar from "react-bootstrap/Navbar";
import NavDropdown from "react-bootstrap/NavDropdown";
import Form from "react-bootstrap/Form";
import { useContext } from "react";
import { Context } from "../App.jsx";

function NavBar() {
  const State = useContext(Context);

  return (
    <Navbar
      expand="lg"
      className="bg-body-tertiary justify-content-between"
      data-bs-theme={State.value}
    >
      <Container>
        <Navbar.Brand href="#home">LIV CVL</Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="me-auto">
            <Nav.Link href="#home">Accueil</Nav.Link>
            <Nav.Link href="#link">Matchs</Nav.Link>
            <NavDropdown title="Mon Compte" id="basic-nav-dropdown">
              <NavDropdown.Item href="#action/3.1">Action</NavDropdown.Item>
              <NavDropdown.Item href="#action/3.2">
                Another action
              </NavDropdown.Item>
              <NavDropdown.Item href="#action/3.3">Something</NavDropdown.Item>
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
                onChange={(e) =>
                  State.setter(e.target.checked ? "dark" : "light")
                }
              />
            </Form>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default NavBar;
