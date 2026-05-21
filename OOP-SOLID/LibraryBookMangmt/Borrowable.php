<?php

interface Borrowable
{
    public function checkout() ;   // mark item as unavailable
    public function returnItem();     // mark item as available again
    public function isAvailable(); // return the current availability
}