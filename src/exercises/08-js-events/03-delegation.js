let cardsContainer = document.getElementById("cards");
function handleClicks(e) {
  const card = e.target.closest(".card");
  if (!card) {
    return;
  }
  const action = e.target.dataset.action;
  if (action === "select") {
    console.log("You clicked on select button");
    toggleCardHighlight(card);
  } else if (action === "log") {
    logCardTitle(card);
  }
}
cardsContainer.addEventListener("click", handleClicks);
function toggleCardHighlight(card) {
  card.classList.toggle("selected");
}
function logCardTitle(card) {
  console.log("Card:", card.dataset.title);
}
