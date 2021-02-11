<?php
spl_autoload_register('my_autoloader');

//Class below represents orders
class Order implements SplSubject
{
    
    private float $price; //order cost
    private TaxStrategy $taxStrat; //stores tax calculation strategy (TaxStrategy object)
    private float $tax;
    private SplObjectStorage $_observers;

    public function __construct($price, $strategy) {
        $this->_observers = new SplObjectStorage();
        $this->price = $price;
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
    //sets new price
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function getPrice()
    {
        return $this->price;
    }
    //returns order price with tax included
    public function getTotalAmount() {
         $this->tax = $this->taxStrat->calculateTax($this->price);
         $this->notify();
         return $this->price + $this->tax;
    }

    public function attach(SplObserver $observer)
    {
        $this->_observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->_observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->_observers as $observer) {
            $observer->update($this);
            break;
        }
    }
}