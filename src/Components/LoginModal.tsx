import { useContext, useEffect, useState } from "react";
import { Modal, Button, Form, Alert, InputGroup } from "react-bootstrap";
import { postDataAuth } from "../services/ApiService";
import { startSession } from "../Utils/session";
import { ContextConnected } from "../App";

function LoginModal(props: any) {
  const StateConnected = useContext(ContextConnected);
  const [response, setResponse] = useState<any>(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  let [email, setEmail] = useState("");
  let [password, setPassword] = useState("");

  const [emailValid, setEmailValid] = useState(false);
  const [passwordValid, setPasswordValid] = useState(false);
  const [formError, setFormError] = useState("");
  const [formSubmitted, setFormSubmitted] = useState(false);
  const [showAlert, setShowAlert] = useState(false);

  if (response != null) {
    if (response.success) {
      startSession(
        response.token,
        response.user.id,
        response.user.username,
        response.user.email,
        response.user.darkTheme == 0 ? "light" : "dark"
      );
      StateConnected.setter(true);
      props.onHide();
      location.reload();
    }
  }

  const fetchData = async () => {
    setLoading(true);
    setError(null);
    try {
      const data = {
        email: email,
        password: password,
      }; // Données à envoyer
      const result = await postDataAuth(
        "https://api.livcvl.fr/api/auth/login.php",
        data
      );
      setResponse(result);
    } catch (err: any) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  function LogUser() {
    setFormSubmitted(true);
    if (emailValid && passwordValid) {
      setShowAlert(false);
      fetchData();
    } else {
      setShowAlert(true);
      setFormError("Veuillez remplir tous les champs correctement.");
    }
  }

  return (
    <Modal
      {...props}
      size="md"
      aria-labelledby="contained-modal-title-vcenter"
      centered
    >
      <Modal.Header closeButton>
        <Modal.Title id="contained-modal-title-vcenter">Connexion</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <Form
          onSubmit={(e) => {
            e.preventDefault();
            LogUser();
          }}
        >
          <Form.Group className="mb-3" controlId="loginForm.email">
            <Form.Label>Adresse Email</Form.Label>
            <InputGroup>
              <Form.Control
                type="text"
                placeholder="aa00000"
                autoFocus
                onChange={(e) => {
                  let tEmail = e.target.value + "@ndoverneuil.net";
                  if (e.target.value.length == 7) {
                    setEmailValid(true);
                    setEmail(tEmail);
                  } else {
                    setEmailValid(false);
                  }
                }}
                isValid={emailValid}
                isInvalid={!emailValid}
              />
              <InputGroup.Text>@ndoverneuil.net</InputGroup.Text>
            </InputGroup>
          </Form.Group>
          <Form.Group className="mb-3" controlId="loginForm.password">
            <Form.Label>Mot de passe</Form.Label>
            <InputGroup className="mb-3">
              <InputGroup.Text id="basic-addon1">🔑</InputGroup.Text>
              <Form.Control
                type="password"
                placeholder="Mot de passe"
                autoFocus
                autoComplete="current-password"
                onChange={(e) => {
                  let tPassword = e.target.value;
                  if (tPassword !== "") {
                    setPasswordValid(true);
                    setPassword(tPassword);
                  } else {
                    setPasswordValid(false);
                  }
                }}
                isInvalid={!passwordValid}
              />
            </InputGroup>
          </Form.Group>
          <Form.Control type="submit" hidden />
        </Form>
        {showAlert && formSubmitted && (!emailValid || !passwordValid) && (
          <Alert variant="danger">{formError}</Alert>
        )}
        {response != null && (
          <Alert
            variant={
              response != null && response.success ? "success" : "danger"
            }
          >
            {response.message}
          </Alert>
        )}
      </Modal.Body>
      <Modal.Footer>
        <Button variant="secondary" onClick={props.onHide}>
          Close
        </Button>
        <Button variant="primary" onClick={() => LogUser()}>
          Se Connecter
        </Button>
      </Modal.Footer>
    </Modal>
  );
}

export default LoginModal;
