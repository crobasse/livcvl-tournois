import { useEffect, useRef, useState } from "react";
import { Modal, Button, Form, InputGroup, Col, Alert } from "react-bootstrap";
import { postData, postDataAuth } from "../services/ApiService";
import {
  isEmailValid,
  isPasswordValid,
  isUsernameValid,
} from "../Utils/checkers";
import { startSession } from "../Utils/session";

function RegisterModal(props: any) {
  const [response, setResponse] = useState<any>(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  let [user, setUser] = useState("");
  let [email, setEmail] = useState("");
  let [password, setPassword] = useState("");

  const [userValid, setUserValid] = useState(false);
  const [emailValid, setEmailValid] = useState(false);
  const [passwordValid, setPasswordValid] = useState(false);
  const [formError, setFormError] = useState("");
  const [formSubmitted, setFormSubmitted] = useState(false);
  const [showAlert, setShowAlert] = useState(false);

  const fetchData = async () => {
    setLoading(true);
    setError(null);
    try {
      const data = {
        email: email,
        username: user,
        password: password,
      }; // Données à envoyer
      const result = await postDataAuth(
        "https://api.livcvl.fr/api/auth/register.php",
        data
      );
      setResponse(result);
    } catch (err: any) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  if (response != null) {
    if (response.success) {
      startSession(
        response.token,
        response.user.id,
        response.user.username,
        response.user.email,
        response.user.darkTheme == 0 ? "light" : "dark"
      );
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
        <Modal.Title id="contained-modal-title-vcenter">
          Inscription
        </Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <Form>
          <Form.Group className="mb-3" controlId="loginForm.username">
            <Form.Label>Nom d'utilisateur</Form.Label>
            <InputGroup className="mb-3">
              <InputGroup.Text id="basic-addon1">@</InputGroup.Text>
              <Form.Control
                type="text"
                placeholder="Username"
                autoFocus
                autoComplete="user"
                onChange={(e) => {
                  let tUser = e.target.value;
                  if (isUsernameValid(tUser)) {
                    setUserValid(true);
                    setUser(tUser);
                  } else {
                    setUserValid(false);
                  }
                }}
                isValid={userValid}
                isInvalid={!userValid}
              />
            </InputGroup>
          </Form.Group>
          <Form.Group className="mb-3" as={Col} controlId="loginForm.email">
            <Form.Label>Adresse Email</Form.Label>
            <InputGroup className="mb-3">
              <Form.Control
                type="username"
                placeholder="aa00000"
                autoFocus
                autoComplete="email"
                onChange={(e) => {
                  let tEmail = e.target.value + "@ndoverneuil.net";
                  if (isEmailValid(tEmail) && e.target.value.length == 7) {
                    setEmailValid(true);
                    setEmail(tEmail);
                  } else {
                    setEmailValid(false);
                  }
                }}
                isValid={emailValid}
                isInvalid={!emailValid}
              />
              <InputGroup.Text id="basic-addon2">
                @ndoverneuil.net
              </InputGroup.Text>
            </InputGroup>
          </Form.Group>
          <Form.Control.Feedback type="invalid">
            Email invalide
          </Form.Control.Feedback>
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
                  if (isPasswordValid(tPassword)) {
                    setPasswordValid(true);
                    setPassword(tPassword);
                  } else {
                    setPasswordValid(false);
                  }
                }}
                isValid={passwordValid}
                isInvalid={!passwordValid}
              />
            </InputGroup>
            <Form.Text id="passwordHelpBlock" muted>
              Votre mot de passe doit comporter entre 8 et 20 caractères,
              contenir des lettres, des chiffres et des caractères spéciaux, et
              ne doit pas contenir d'espaces ou d'émojis.
            </Form.Text>
          </Form.Group>
        </Form>
        {showAlert &&
          formSubmitted &&
          (!userValid || !emailValid || !passwordValid) && (
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
        <Button
          variant="primary"
          onClick={() => {
            setFormSubmitted(true);
            if (userValid && emailValid && passwordValid) {
              setShowAlert(false);
              fetchData();
            } else {
              setShowAlert(true);
              setFormError("Veuillez remplir tous les champs correctement.");
            }
          }}
        >
          S'inscrire
        </Button>
      </Modal.Footer>
    </Modal>
  );
}

export default RegisterModal;
