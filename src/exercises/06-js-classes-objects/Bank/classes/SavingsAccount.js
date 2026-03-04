import BankAccount from "./BankAccount.js";
class SavingsAccount extends BankAccount {
  constructor(_num, _name, _bal, _rate) {
    super(_num, _name, _bal);
    this.interestRate = _rate;
  }
  toString() {
    let rate = this.interestRate * 100;
    return `Savings Account: ${this.number}, Name: ${this.name}, Balance: €${this.balance}, Interest: ${rate}%`;
  }
}
export default SavingsAccount;
