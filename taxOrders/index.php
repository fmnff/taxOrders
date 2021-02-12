<?php
function my_autoloader($class) {
    include $class . '.php';
}
spl_autoload_register('my_autoloader');

//creating two orders from the task description
$orders = [new Order(100, new TaxStrategy(0)), new Order(500, new TaxStrategy(0))];
//creating an Observer listener for logging
$logger = new Logger();
//attaching the listener to orders
foreach ($orders as $order) {
    $order->attach($logger);
}
//existing tax rates
$rates = [0, 5, 20];

foreach ($orders as $order) {
    foreach ($rates as $rate) {
        $order->setTaxStrat(new TaxStrategy($rate)); //applying new tax rate to an order
        //printing order info & calculation results
        echo ">> Order cost: " . $order->getPrice() . "$, tax: " . $order->getTaxStrat()->getTaxRate()
            . "%, total: " . $order->getTotalAmount() . "$.<br>";
    }
}