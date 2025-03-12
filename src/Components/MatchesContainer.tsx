import { Table } from "react-bootstrap";
import React, { useState, Suspense, useEffect, useContext } from "react";
import { postData } from "../services/ApiService";
import { Match } from "../Utils/interfaces";
import { Context } from "../App";

const MatchesContainer: React.FC = () => {
  const State = useContext(Context);

  const [response, setResponse] = useState<any>(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const fetchData = async () => {
    setLoading(true);
    setError(null);
    try {
      const data = { key: "value" }; // Données à envoyer
      const result = await postData(
        "http://localhost:90/api/matches/match",
        data
      );
      setResponse(result);
    } catch (err: any) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchData();
  }, []);

  return (
    <Suspense
      fallback={
        <tr>
          <td>
            <span>Chargement...</span>
          </td>
        </tr>
      }
    >
      <div>
        <Table responsive="sm" data-bs-theme={State.value}>
          <thead>
            <tr>
              <th>Équipe 1</th>
              <th>Équipe 2</th>
              <th>Date</th>
              <th>Score</th>
              <th>State</th>
            </tr>
          </thead>
          <tbody>
            {
              <tr>
                <td>
                  {loading}
                  <span>Chargement...</span>
                </td>
              </tr>
            }
            {
              <tr>
                <td>
                  {error}
                  <span style={{ color: "red" }}>{error}</span>
                </td>
              </tr>
            }
            {response ? (
              response.matches.map((match: Match) => (
                <tr>
                  <td>{match.teamHome.name}</td>
                  <td>{match.teamAway.name}</td>
                  <td>{match.dateMatch}</td>
                  <td>
                    {match.scoreHome} - {match.scoreAway}
                  </td>
                  <td>{match.status}</td>
                </tr>
              ))
            ) : (
              <tr>
                <td>
                  <span>Aucune donnée</span>
                </td>
              </tr>
            )}
          </tbody>
        </Table>
      </div>
    </Suspense>
  );
};

export default MatchesContainer;
