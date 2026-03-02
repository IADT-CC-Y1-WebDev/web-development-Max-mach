console.log("hello world");

let user = {
  firstname: "Lolo",
  lastname: "LOLIto",
  age: 18,
  hobies: ["football", "basketball", "golf"],
  friend: [
    {
      lol: "bob",
    },
  ],
};
console.log(user.age);
console.log(user.friend[0]);
const movie = [10, 20, 30, 40, 50, 60];
for (let i = 0; i < movie.length; i++) {
  const element = movie[i];
  if (element > 20) {
    console.log("bobr");
  } else {
    console.log("anti bobr");
  }
}
movie.forEach(function (bobi, index) {
  console.log(bobi);
  console.log(index, bobi);
});
movie.forEach((lol) => {
  console.log(lol);
});
