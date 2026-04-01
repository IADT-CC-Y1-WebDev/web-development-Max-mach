console.log("bobi");
let applyBtn = document.getElementById("apply_filters");
let clearBTN = document.getElementById("clear_filters");
let form = document.getElementById("filters");
let cards = document.querySelectorAll(".card");
let cardsContainer = document.getElementById("book-cards");
applyBtn.addEventListener("click", (e) => {
  e.preventDefault();
  applyFilters();
});
clearBTN.addEventListener("click", (e) => {
  e.preventDefault();
  clearFilters();
});

function applyFilters() {
  let filters = getFilters();
  for (let i = 0; i < cards.length; i++) {
    let card = cards[i];
    let match = cardMatches(card, filters);
    if (!match) {
      card.classList.add("hidden");
    } else {
      card.classList.remove("hidden");
    }
  }
  let cardsArray = Array.from(cards);
  const sorted = sortCards(cardsArray, filters.sortBy);
  sorted.forEach((card) => {
    cardsContainer.appendChild(card);
  });
}
function sortCards(cards, sortBy) {
  const list = cards.slice();
  list.sort((a, b) => {
    let titleA = a.dataset.title.toLowerCase();
    let titleB = b.dataset.title.toLowerCase();
    if (sortBy === "all") return yearB - yearA;
    return titleA.localeCompare(titleB);
  });
  return list;
}
function getFilters() {
  const titleEl = form.elements["title_filter"];
  const yearEl = form.elements["sort_by"];

  let titleFilter = (titleEl.value || "").trim().toLowerCase();
  let yearFilter = yearEl.value || "all";

  return {
    titleFilter: titleFilter,
    yearFilter: yearFilter,
  };
}
function clearFilters() {
  form.reset();
  cards.forEach((card) => {
    card.classList.remove("hidden");
  });
  let cardsArray = Array.from(cards);
  const sorted = sortCards(cardsArray, "title");
  sorted.forEach((card) => {
    cardsContainer.appendChild(card);
  });
}
function cardMatches(card, filter) {
  let title = card.dataset.title.toLowerCase();
  let year = Number(card.dataset.year);
  let yearMatch;

  let matchTitle = !filter.titleFilter || title.includes(filter.titleFilter);
  if (filter.yearFilter === "all") {
    yearMatch = year;
  }
  if (filter.yearFilter === "before_2000") {
    yearMatch = year < 2000;
  }
  if (filter.yearFilter === "2000_and_later") {
    yearMatch = year >= 2000;
  }
  return matchTitle && yearMatch;
}
