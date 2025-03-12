import { Suspense } from "react";
import MatchesContainer from "../Components/MatchesContainer";

function Home() {
  return (
    <div>
      <Suspense fallback={<h1>Loading...</h1>}>
        <h1>Home Page</h1>
        <MatchesContainer />
      </Suspense>
    </div>
  );
}

export default Home;
