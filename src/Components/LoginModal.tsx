import { Modal, Button, Form } from "react-bootstrap";

function LoginModal(props: any) {
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
        <Form>
          <Form.Group className="mb-3" controlId="loginForm.email">
            <Form.Label>Adresse Email</Form.Label>
            <Form.Control
              type="email"
              placeholder="nom@example.fr"
              autoFocus
              autoComplete="username"
            />
          </Form.Group>
          <Form.Group className="mb-3" controlId="loginForm.password">
            <Form.Label>Mot de passe</Form.Label>
            <Form.Control
              type="password"
              placeholder="Mot de passe"
              autoFocus
              autoComplete="current-password"
            />
          </Form.Group>
        </Form>
      </Modal.Body>
      <Modal.Footer>
        <Button variant="secondary" onClick={props.onHide}>
          Close
        </Button>
        <Button variant="primary" onClick={props.onHide}>
          Se Connecter
        </Button>
      </Modal.Footer>
    </Modal>
  );
}

export default LoginModal;
