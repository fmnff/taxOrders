<?php


class Logger implements SplObserver
{
    private string $name;
    public function __construct() {
        $this->name = "log.txt";
    }
    public function update(SplSubject $subject)
    {
        file_put_contents($this->name, "Checked out order: cost " . $subject->getPrice() . "$, tax " .
            $subject->getTaxStrat()->getTaxRate() . "%, total " . ($subject->getPrice() + $subject->getTax()) .
            "$ on " . date("F j, Y") . " at " . date("h:i:sa") . ".\n", FILE_APPEND);
    }
}