export const postData = async (url: string, data: any) => {
  try {
    const response = await fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });
    if (!response.ok) {
      throw new Error("Erreur lors de la requête API");
    }
    return await response.json();
  } catch (error) {
    console.error(error);
    throw error;
  }
};
