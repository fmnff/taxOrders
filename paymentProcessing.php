<?php
function my_autoloader($class) {
    include $class . '.php';
}
spl_autoload_register('my_autoloader');

$orders = [new Order(100, new TaxStrategy(0)), new Order(500, new TaxStrategy(0))];
$logger = new Logger();
foreach ($orders as $order) {
    $order->attach($logger);
}
$rates = [0, 5, 20];

foreach ($rates as $rate) {
    foreach ($orders as $order) {
        $order->setTaxStrat(new TaxStrategy($rate));
        echo ">> Order cost: " . $order->getPrice() . "$, tax: " . $order->getTaxStrat()->getTaxRate()
            . "%, total: " . $order->getTotalAmount() . "$.\n";
    }
}