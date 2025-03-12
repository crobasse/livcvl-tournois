import { Suspense } from "react";
import ErrorBoundary from "../Components/ErrorBoundary";
import MatchesContainer from "../Components/MatchesContainer";

function Home() {
  return (
    <div>
      <h1>Home Page</h1>
      <ErrorBoundary>
        <Suspense fallback={<div>Loading...</div>}>
          <MatchesContainer />
        </Suspense>
      </ErrorBoundary>
    </div>
  );
}

export default Home;
