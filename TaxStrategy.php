<?php
spl_autoload_register('my_autoloader');

//class below incapsulates tax calculation strategy
class TaxStrategy
{
    private $taxRate; //tax rate in percents

    public function __construct($taxRate) {
        $this->taxRate = $taxRate;
    }
    //sets new tax rate
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;
    }
    public function getTaxRate()
    {
        return $this->taxRate;
    }
    //calculates tax for an order based on the set rate
    public function calculateTax($orderTotal) {
        return $orderTotal * $this->taxRate / 100;
    }
}