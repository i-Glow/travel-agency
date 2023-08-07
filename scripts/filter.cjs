const filter = document.querySelector("#filter");

filter.addEventListener("click", applyFilters);

function applyFilters() {
  const dateFilter = document.getElementById("date").value;
  const destinationFilter = document
    .getElementById("destination")
    .value.toLowerCase();
  const priceFilter = parseInt(document.getElementById("price").value);
  const noplaceFilter = parseInt(document.getElementById("noplace").value);

  const cards = document.querySelectorAll(".card");

  cards.forEach((card) => {
    const cardDate = card.querySelector(".loc-date h4").textContent;
    const cardDestination = card
      .querySelector(".loc-date p")
      .textContent.toLowerCase();
    const cardPrice = parseInt(card.querySelector(".book-ctn h2").textContent);
    const cardNoplace = parseInt(card.querySelector(".book-ctn input").value);

    const showCard =
      (!dateFilter || cardDate === dateFilter) &&
      (!destinationFilter || cardDestination.includes(destinationFilter)) &&
      (!priceFilter || cardPrice <= priceFilter) &&
      (!noplaceFilter || cardNoplace >= noplaceFilter);

    card.style.display = showCard ? "block" : "none";
  });
}
