import { useState } from "react";
import getData from "../Utils/getData";

function sleep(ms: number) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

const MatchesContainer = () => {
  let [data, setData] = useState("");

  sleep(1000);
  getData("http://livcvl/api/matches/match", "posts", setData);

  return (
    <div className="row">
      <div className="col-12">Data: {data}</div>
    </div>
  );
};

export default MatchesContainer;
