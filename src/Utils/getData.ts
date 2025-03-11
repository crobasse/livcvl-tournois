async function getData(url: string, data: string, setData: Function) {
  const requestOptions = {
    method: "POST",
  };
  return await fetch(url, requestOptions)
    .then((response) => response.json())
    .then((data) => console.log(data));
}

export default getData;
