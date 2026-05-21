<?php
// given a square matrix nxn, a position of queen [row,column], f number of obstacles on the matrix with coordinates
// [row, column] count how many free areas queen has when she moves before hiting obstacle or edge.

require_once 'Point.php';
require_once 'ChessSettings.php';
require_once 'MoverClass.php';

use queensAttack\Point;
use queensAttack\ChessSettings;
use queensAttack\MoverClass;

$cs = new ChessSettings();

$mc = new MoverClass($cs);

$mc->moveAndCountAll($cs);
$mc->PrintOutCounter();
