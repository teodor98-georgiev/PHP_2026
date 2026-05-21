<?php

class Magazine extends LibraryItem
{
    private $issue;
    private $publisher;

    public function __construct($title, $issue, $publisher) {
        parent::__construct( $title );
    }

    // Polymorphism: same method name, different output than Book
    public function getSummary() {
        return "\"{$this->title}\" issue #{$this->issue} by {$this->publisher}";
    }
}