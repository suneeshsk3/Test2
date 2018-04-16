<?php

class BankAccount implements IfaceBankAccount
{

    private $balance = null;

    public function __construct(Money $openingBalance)
    {
        $this->balance = $openingBalance;
    }

    public function balance()
    {
        return $this->balance;
    }

    public function deposit(Money $amount)
    {
        $this->balance = new Money($this->balance->value() + $amount->value());
    }

    public function transfer(Money $amount, BankAccount $account)
    {
        $this->balance      = new Money($this->balance->value() - $amount->value());
        $account->balance   = new Money($account->balance->value() + $amount->value());
    }

    public function withdraw(Money $amount)
    {   
        if($this->balance->value() < $amount->value())
            throw new Exception("Withdrawl amount larger than balance");
        else
            $this->balance = new Money($this->balance->value() - $amount->value());
    }
}