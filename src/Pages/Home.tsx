import React, { Suspense } from "react";
import ErrorBoundary from "../Components/ErrorBoundary";

function Home() {
  const MatchesContainerLoader = React.lazy(() =>
    import("../Components/MatchesContainer").then((module: any) => {
      return new Promise((resolve) => setTimeout(() => resolve(module), 3000));
    })
  );

  return (
    <div>
      <h1>Home Page</h1>
      <ErrorBoundary>
        <Suspense fallback={<div>Loading...</div>}>
          <MatchesContainerLoader />
        </Suspense>
      </ErrorBoundary>
    </div>
  );
}

export default Home;
