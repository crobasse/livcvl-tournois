import { useParams } from "react-router-dom";
import ErrorBoundary from "../Components/ErrorBoundary";
import { Card, Col, Container, Placeholder, Row } from "react-bootstrap";
import { Suspense, useEffect, useState } from "react";
import { postData, postDataAuth } from "../services/ApiService";
import { format } from "date-fns";

function BetPage() {
  const params = useParams();
  const matchId = params.matchId;

  const [response, setResponse] = useState<any>(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const fetchData = async () => {
    setLoading(true);
    setError(null);
    try {
      const data = { id: matchId }; // Données à envoyer
      const result = await postDataAuth(
        "https://api.livcvl.fr/api/matches/match.php",
        data
      );
      setResponse(result);
    } catch (err: any) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  const [choice, setChoice] = useState(-1);

  useEffect(() => {
    fetchData();
  }, []);

  var loadingMessage = "Chargement...";
  var errorMessage = "Erreur lors de la requête API";

  return (
    <>
      <ErrorBoundary>
        <Container className="mt-5">
          <Row>
            <Card className="bg-body-tertiary">
              <Card.Body>
                <Row>
                  <Col>
                    {response ? (
                      <h2>{response.match.class}</h2>
                    ) : (
                      <Placeholder as={Card.Title} animation="glow">
                        <Placeholder xs={6} />
                      </Placeholder>
                    )}
                    <Card.Title>
                      {response ? (
                        <>
                          {response.match.teamHome.name} vs{" "}
                          {response.match.teamAway.name}
                        </>
                      ) : (
                        <Placeholder as={Card.Title} animation="glow">
                          <Placeholder xs={5} />
                        </Placeholder>
                      )}
                    </Card.Title>
                  </Col>
                  <Col md="auto">
                    {response ? (
                      format(
                        new Date(Date.parse(response.match.date)),
                        "dd/MM/yyyy HH:mm"
                      )
                    ) : (
                      <Placeholder as={Card.Title} animation="glow">
                        <Placeholder xs={5} />
                      </Placeholder>
                    )}
                  </Col>
                </Row>
              </Card.Body>
            </Card>
          </Row>
          <Row className="mt-4">
            <Card className="bg-body-tertiary">
              <Card.Body>
                <Row>
                  <Col>
                    <h3>Parier sur le match</h3>
                  </Col>
                </Row>
                <Row className="text-center">
                  {response ? (
                    <>
                      <Col className="col-sm-4 mt-4">
                        <Row className="mb-3">
                          <Card
                            className={choice === 0 ? "bg-primary" : ""}
                            onClick={() => setChoice(0)}
                            role="button"
                          >
                            <Card.Body>
                              <Card.Text>
                                <b>{response.match.teamHome.name}</b>
                              </Card.Text>
                              <Card.Title>
                                <h3>{response.match.cotes.home_win}</h3>
                              </Card.Title>
                            </Card.Body>
                          </Card>
                        </Row>
                        <Row className="mb-3">
                          <Card
                            className={choice === 1 ? "bg-primary" : ""}
                            onClick={() => setChoice(1)}
                            role="button"
                          >
                            <Card.Body>
                              <Card.Text>
                                <b>Egalité</b>
                              </Card.Text>
                              <Card.Title>
                                <h3>{response.match.cotes.draw}</h3>
                              </Card.Title>
                            </Card.Body>
                          </Card>
                        </Row>
                        <Row>
                          <Card
                            className={choice === 2 ? "bg-primary" : ""}
                            onClick={() => setChoice(2)}
                            role="button"
                          >
                            <Card.Body>
                              <Card.Text>
                                <b>{response.match.teamAway.name}</b>
                              </Card.Text>
                              <Card.Title>
                                <h3>{response.match.cotes.away_win}</h3>
                              </Card.Title>
                            </Card.Body>
                          </Card>
                        </Row>
                      </Col>
                      <Col className="col-sm-8">
                        <Row className="mb-3"></Row>
                      </Col>
                    </>
                  ) : (
                    <Placeholder as={Card.Title} animation="glow">
                      <Placeholder xs={10} />
                    </Placeholder>
                  )}
                </Row>
              </Card.Body>
            </Card>
          </Row>
        </Container>
      </ErrorBoundary>
    </>
  );
}

export default BetPage;
