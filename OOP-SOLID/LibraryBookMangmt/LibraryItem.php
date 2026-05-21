<?php

abstract class LibraryItem implements Borrowable{
    protected  $title;
    protected $available = true;

    public function __construct($title) {
        $this->title = $title;
    }


    public function checkout() {
        $this->available = false; }
    public function returnItem()    {
        $this->available = true; }
    public function isAvailable() {
        return $this->available; }

    abstract public function getSummary();

    public function getTitle() {
        return $this->title; }
}
