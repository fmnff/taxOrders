<?php
spl_autoload_register('my_autoloader');

//Class below represents orders
class Order implements SplSubject
{
    
    private float $price; //order cost
    private TaxStrategy $taxStrat; //stores tax calculation strategy (TaxStrategy object)
    private float $tax; //tax value
    private SplObjectStorage $_observers; //Observer listeners

    public function __construct($price, $strategy) {
        $this->_observers = new SplObjectStorage();
        $this->price = $price;
        $this->taxStrat = $strategy;
    }
    public function setTaxStrat($taxStrat)
    {
        $this->taxStrat = $taxStrat;
    }
    public function getTax()
    {
        return $this->tax;
    }
    public function getTaxStrat()
    {
        return $this->taxStrat;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function getPrice()
    {
        return $this->price;
    }
    //returns order total with price and tax included
    public function getTotalAmount() {
         $this->tax = $this->taxStrat->calculateTax($this->price);
         $this->notify(); //notifies Observer listeners about order chekout
         return $this->price + $this->tax;
    }
    //adds new Observer listener
    public function attach(SplObserver $observer)
    {
        $this->_observers->attach($observer);
    }
    //removes Observer listener
    public function detach(SplObserver $observer)
    {
        $this->_observers->detach($observer);
    }
    //notifies Observer listeners
    public function notify()
    {
        foreach ($this->_observers as $observer) {
            $observer->update($this);
            break;
        }
    }
}