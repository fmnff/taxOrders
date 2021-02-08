<?php
function my_autoloader($class) {
    include $class . '.php';
}
spl_autoload_register('my_autoloader');

$orders = [new Order(100, new TaxStrategy(0)), new Order(500, new TaxStrategy(0))];
$rates = [0, 5, 20];

foreach ($rates as $rate) {
    foreach ($orders as $order) {
        $order->getTaxStrat()->setTaxRate($rate);
        echo ">> Order cost: " . round($order->getTotal(), 2) . "$, tax: " . $order->getTaxStrat()->getTaxRate()
            . "%, total: " . round($order->getTotalAmount(), 2) . "$.\n";
    }
}