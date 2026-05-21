<?php

namespace queensAttack;

class ChessSettings
{
    public $queenStartPoint;
    public $surfCounter = 0;

    // Allowed steps for exercise scope
    public $stepsX = [-1, -1, -1, 0, 1, 1, 1, 0];
    public  $stepsY = [-1, 0, 1, 1, 1, 0, -1, -1];

    // Edges diagonally
    public $edgeUpLeft;
    public $edgeUpRight;
    public $edgeDownLeft;
    public $edgeDownRight;

    // Edges crossly
    public $leftXEdge;
    public $rightXEdge;
    public $upYedge;
    public $downYedge;

    // Obstacles coordinates
    public $obst1;
    public $obst2;

    public function __construct()
    {
        $this->queenStartPoint = new Point(5, 3);

        $this->edgeUpLeft    = new Point(1, 6);
        $this->edgeUpRight   = new Point(6, 6);
        $this->edgeDownLeft  = new Point(6, 6);
        $this->edgeDownRight = new Point(6, 6);

        $this->leftXEdge  = new Point(1, 0);
        $this->rightXEdge = new Point(6, 0);
        $this->upYedge    = new Point(0, 6);
        $this->downYedge  = new Point(0, 1);

        $this->obst1 = new Point(2, 3);
        $this->obst2 = new Point(4, 5);
    }

}