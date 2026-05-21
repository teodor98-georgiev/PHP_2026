<?php

namespace queensAttack;

use Comparator;

class MoverClass
{
    private $cs;

    public function __construct(ChessSettings $cs)
    {
        $this->cs = $cs;
    }

    public function moveAndCountAll()
    {
        for ($i = 0; $i < 8; $i++) {
            $this->moveAndCountSingle($this->cs->stepsX[$i], $this->cs->stepsY[$i]);
        }
    }

    public function moveAndCountSingle($xStep, $yStep)
    {
        $tempPoint = new Point($this->cs->queenStartPoint->x, $this->cs->queenStartPoint->y);
        $comparator = new Comparator();

        while (true) {
            $tempPoint->x = $tempPoint->x + $xStep;
            $tempPoint->y = $tempPoint->y + $yStep;

            // Obstacle check
//            if ($tempPoint->x === $this->cs->obst1->x && $tempPoint->y === $this->cs->obst1->y) {
//                break;
//            }

            if ($comparator->isEqual($tempPoint->x,$this->cs->obst1->x) && ($comparator->isEqual($tempPoint->y,$this->cs->obst1->y))){
                break;
            }
            if ($tempPoint->x === $this->cs->obst2->x && $tempPoint->y === $this->cs->obst2->y) {
                break;
            }

            $this->cs->surfCounter++;

            // Diagonal edges check
            if ($tempPoint->x === $this->cs->edgeUpLeft->x && $tempPoint->y === $this->cs->edgeUpLeft->y) {
                break;
            }
            if ($tempPoint->x === $this->cs->edgeUpRight->x && $tempPoint->y === $this->cs->edgeUpRight->y) {
                break;
            }
            if ($tempPoint->x === $this->cs->edgeDownLeft->x && $tempPoint->y === $this->cs->edgeDownLeft->y) {
                break;
            }
            if ($tempPoint->x === $this->cs->edgeDownRight->x && $tempPoint->y === $this->cs->edgeDownRight->y) {
                break;
            }

            // Crossly edges check
            if ($tempPoint->x === $this->cs->leftXEdge->x || $tempPoint->x === $this->cs->rightXEdge->x) {
                break;
            }
            if ($tempPoint->y === $this->cs->upYedge->y || $tempPoint->y === $this->cs->downYedge->y) {
                break;
            }
        }
    }

    public function printOutCounter()
    {
        echo $this->cs->surfCounter . PHP_EOL;
    }
}