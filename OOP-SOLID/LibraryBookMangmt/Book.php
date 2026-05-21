<?php

class Book extends LibraryItem
{
    private $author;
    private $isbn;

    public function __construct( $title,  $author, $isbn) {
        parent::__construct( $title );
        $this->author = $author;
        $this->isbn = $isbn;
    }


    public function getSummary(){
        return "\"{$this->title}\" by {$this->author} (ISBN: {$this->isbn})";
    }
}