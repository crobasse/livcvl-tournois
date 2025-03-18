import { Suspense, useContext } from "react";
import ErrorBoundary from "../Components/ErrorBoundary";
import MatchesContainer from "../Components/MatchesContainer";
import { Context } from "../App";
import "../scss/Home.scss";
import "../scss/colors.scss";

const Home = () => {
  const State = useContext(Context);
  return (
    <div data-bs-theme={State.value} className="home">
      <h1>Liste des matchs</h1>
      <ErrorBoundary>
        <Suspense fallback={<div>Loading...</div>}>
          <MatchesContainer />
        </Suspense>
      </ErrorBoundary>
    </div>
  );
};

export default Home;
