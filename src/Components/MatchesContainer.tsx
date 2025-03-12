import { Suspense, useEffect, useState } from "react";
import getData from "../Utils/getData";
import { ListGroup } from "react-bootstrap";
import fetchData from "../Utils/getData";

const MatchesContainer = () => {
  let [data, setData]: [any, Function] = useState(null);

  useEffect(() => {
    const controller = new AbortController();

    const interval = fetchData(
      "http://localhost:90/api/matches/match",
      {}
    ).then((result) => {
      const interval = setTimeout(() => {
        setData(result);
        return interval;
      }, 3000);
    });

    return () => {
      controller.abort();
      clearTimeout(interval);
    };
  }, []);

  return (
    <>
      {"matches" in data
        ? data.matches.map((breakpoint: any) => (
            <ListGroup
              key={breakpoint}
              horizontal={breakpoint}
              className="my-2"
            >
              <ListGroup.Item>This ListGroup</ListGroup.Item>
              <ListGroup.Item>renders horizontally</ListGroup.Item>
              <ListGroup.Item>on {breakpoint}</ListGroup.Item>
              <ListGroup.Item>and above!</ListGroup.Item>
            </ListGroup>
          ))
        : "No data"}
    </>
  );
};

export default MatchesContainer;
