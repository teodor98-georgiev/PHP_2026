<?php

class Catalog
{
    /** @var Borrowable[] */
    private $items = [];



    // Open/Closed: you can add new item types without changing this class
    public function add(Borrowable $item) {
        $this->items[] = $item;
    }

    // Returns items whose title contains $keyword (case-insensitive)
    public function search( $keyword) {
        $result = [];

        foreach ($this->items as $item) {
            $title = $item->getTitle();

            if (stripos($title, $keyword) !== false) {
                $result[] = $item;
            }
        }

        return $result;
    }

    // Prints getSummary() + availability for every item
    public function listAll() {
        return $this->items;
    }
}