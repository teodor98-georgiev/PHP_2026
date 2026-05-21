<?php


require_once 'Borrowable.php';
require_once 'LibraryItem.php';
require_once 'Book.php';
require_once 'Magazine.php';
require_once 'Catalog.php';


$catalog = new Catalog();
$catalog->add(new Book("Clean Code", "Robert Martin", "978-0132350884"));
$catalog->add(new Magazine("PHP Weekly", 42, "PHP Group"));

$catalog->listAll();

$books = $catalog->search("I am nobody");
foreach ($books as $book) {
    $book->checkout();
}

if (!empty($books)){
    echo $book->isAvailable() ? "available" : "checked out";
    $book->returnItem();
    $book->getSummary();
}
else {
    echo "no results found \n";
}
