import { Suspense } from "react";
import Row from "../Components/Row";

function Home() {
  return (
    <div>
      <Suspense fallback={<h1>Loading...</h1>}>
        <h1>Home Page</h1>
        <Row />
      </Suspense>
    </div>
  );
}

export default Home;
