import React from "react";
import { useQuery } from "react-query";

const fetchData = () => {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve("Data loaded!");
    }, 2000); // Simulating a 2-second delay for data fetching
  });
};

const DataComponent = async () => {
  const apidata = await fetchData(); // This can be any async function, like an API call

  return <div>{"TODO"}</div>;
};

const LoadingSpinner = () => {
  return <div>Loading...</div>;
};

export default fetchData;
export { DataComponent, LoadingSpinner };
