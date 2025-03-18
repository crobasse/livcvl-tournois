import { Table } from "react-bootstrap";
import React, {
  useState,
  Suspense,
  useEffect,
  useContext,
  useMemo,
} from "react";
import { postData } from "../services/ApiService";
import { Match, Status } from "../Utils/interfaces";
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
      const data = {}; // Données à envoyer
      const result = await postData(
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

  const matches = useMemo(() => response, [response]);

  console.log("check");

  var loadingMessage = "Chargement...";
  var errorMessage = "Erreur lors de la requête API";

  useEffect(() => {
    fetchData();
  }, []);

  return (
    <Suspense
      fallback={
        <tr>
          <td>
            <span>{loadingMessage}</span>
          </td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      }
    >
      <div>
        <Table responsive="sm" data-bs-theme={State.value}>
          <thead>
            <tr>
              <th>Équipes</th>
              <th>Groupe</th>
              <th>Date</th>
              <th>Score</th>
              <th>État</th>
            </tr>
          </thead>
          <tbody>
            {loading && (
              <tr>
                <td>
                  <span>{loadingMessage}</span>
                </td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            )}
            {error && (
              <tr>
                <td>
                  <span style={{ color: "red" }}>
                    {errorMessage}: {error}
                  </span>
                </td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            )}
            {response
              ? matches.matches.map((match: Match) => {
                  let date = new Date(
                    Date.parse(match.dateMatch.replace(/-/g, "/"))
                  );
                  return (
                    <tr
                      key={match.id}
                      className="match-line"
                      onClick={() => console.log(match.id)}
                    >
                      <td>
                        {match.teamHome.name} - {match.teamAway.name}
                      </td>
                      <td>{match.class}</td>
                      <td>{date.toLocaleDateString()}</td>
                      <td>
                        {match.scoreHome == null ? 0 : match.scoreHome} -{" "}
                        {match.scoreAway == null ? 0 : match.scoreAway}
                      </td>
                      <td>{Status[match.status]}</td>
                    </tr>
                  );
                })
              : !loading && (
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
