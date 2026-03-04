import BankAccount from "./classes/BankAccount.js";
import SavingsAccount from "./classes/SavingsAccount.js";

let bank = new BankAccount("1111111111", "Alice", 100.0);
let savings = new SavingsAccount("2222222222", "Bob", 500.0, 0.05);

console.log(bank.toString());
console.log(savings.toString());
