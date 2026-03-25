let applyBtn = document.getElementById("apply_filters");
let clearBTN = document.getElementById("clear_filters");
let form = document.getElementById("filters");
let cards = document.querySelectorAll(".card");
let cardsContainer = document.getElementById("game_cards");
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
    card.classList.toggle("hidden", !match);
    console.log(match);
  }
  let cardsArray = Array.from(cards);
  const sorted = sortCards(cardsArray, filters.sortBy);
  sorted.forEach((card) => {
    cardsContainer.appendChild(card);
  });
}
function sortCards(cards) {
  const list = cards.slice();
  list.sort((a, b) => {
    let titleA = a.dataset.title.toLowerCase();
    let titleB = b.dataset.title.toLowerCase();
    return titleA.localeCompare(titleB);
  });
  return list;
}
function getFilters() {
  const titleEl = form.elements["title_filter"];
  const authorEl = form.elements["author_filter"];
  const yearEl = form.elements["sort_by"];

  let titleFilter = (titleEl.value || "").trim().toLowerCase();
  let authorFilter = (authorEl.value || "").trim().toLowerCase();
  let yearFilter = yearEl.value || "all";

  return {
    titleFilter: titleFilter,
    authorFilter: authorFilter,
    yearFilter: yearFilter,
  };
}
function clearFilters() {
  form.reset();
  cards.forEach((card) => {
    card.classList.toggle("hidden");
  });

  let cardsArray = Array.from(cards);
  const sorted = sortCards(cardsArray, "title");
  sorted.forEach((card) => {
    cardsContainer.appendChild(card);
  });
}
function matchTitle(card, title) {
  const ttl = title.toLowerCase();
  let match = false;
  if (card.dataset.title.includes(title)) {
    match = true;
  }
  return match;
}
function cardMatches(card, filter) {
  let title = card.dataset.title.toLowerCase();
  let author = card.dataset.author.toLowerCase();
  let year = Number(card.dataset.year);
  let yearMatch;

  let matchTitle = !filter.titleFilter || title.includes(filter.titleFilter);
  let matchAuthor =
    !filter.authorFilter || author.includes(filter.authorFilter);

  if (filter.yearFilter === "before_2000") {
    yearMatch = year < 2000;
  }
  if (filter.yearFilter === "2000_and_later") {
    yearMatch = year >= 2000;
  }
  return matchTitle && matchAuthor && yearMatch;
}
