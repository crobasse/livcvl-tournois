async function getData(url: string, data: string, setData: Function) {
  const requestOptions = {
    method: "POST",
  };
  await fetch(url, requestOptions).then(async (response) => {
    const res = await response.json();
    console.log(res);
    setData(res.data);
  });
}

export default getData;
