<?php
spl_autoload_register('my_autoloader');

//Class below represents orders
class Order
{
    private float $total = 0; //total order cost
    private TaxStrategy $taxStrat; //stores tax calculation strategy (TaxStrategy object)
    private float $tax = -1;

    public function __construct($total, $strategy) {
        $this->total = $total;
        $this->taxStrat = $strategy;
    }
    //sets new tax strategy
    public function setTaxStrat($taxStrat)
    {
        $this->taxStrat = $taxStrat;
    }

    //returns tax value or -1 if not calculated yet
    public function getTax()
    {
        return $this->tax;
    }
    public function getTaxStrat()
    {
        return $this->taxStrat;
    }
    //sets new total
    public function setTotal($total)
    {
        $this->total = $total;
    }
    public function getTotal()
    {
        return $this->total;
    }
    //returns order total with tax included
    public function getTotalAmount() {
        return $this->taxStrat->calculateTax($this->total) + $this->total;
    }

}