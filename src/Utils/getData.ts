import axios from "axios";

async function getData(url: string, data: string, setData: Function) {
  const requestOptions = {
    method: "POST",
  };
  await fetch(url, requestOptions).then(async (response) => {
    const res = await response.json();
    console.log(res);

    if (res.error) {
      setData({ matches: [] });
    } else {
      setData(res.data);
    }
  });
}

function fetchData(url: string, options: object) {
  return (
    axios
      .get(url, options)
      // Fetch request has succeeded
      .then((response) => response.data)
      // Fetch request has failed
      .catch((error) => {
        throw error;
      })
  );
}

export default fetchData;
