import React, { useState, Suspense } from "react";
import { postData } from "../services/ApiService";

const DataFetcher: React.FC = () => {
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

  return (
    <Suspense fallback={<p>Chargement...</p>}>
      <div>
        <button onClick={fetchData} disabled={loading}>
          Envoyer requête
        </button>
        {loading && <p>Chargement...</p>}
        {error && <p style={{ color: "red" }}>{error}</p>}
        {response ? (
          <pre>{JSON.stringify(response, null, 2)}</pre>
        ) : (
          <p>Aucune donnée</p>
        )}
      </div>
    </Suspense>
  );
};

export default DataFetcher;
