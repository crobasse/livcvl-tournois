import { useState } from "react";
import getData from "../Utils/getData";

const Row = () => {
  let [data, setData] = useState("");

  let res = getData(
    "https://api.livcvl.fr/api/matches/match",
    "posts",
    setData
  );

  return (
    <div className="row">
      Data:
      <div className="col-12">{data}</div>
    </div>
  );
};

export default Row;
