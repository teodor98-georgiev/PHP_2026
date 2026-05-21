<?php
/**
 * Tests for Queens Attack
 *
 * Board: 6×6, queen at (5,3), obstacles at (2,3) and (4,5).
 *
 * Expected reachable squares per direction:
 *   right      (+1,  0): 1  → hits right edge at x=6
 *   left       (-1,  0): 2  → blocked by obstacle at (2,3)
 *   up         ( 0, +1): 3  → hits top edge at y=6
 *   down       ( 0, -1): 2  → hits bottom edge at y=1
 *   up-right   (+1, +1): 1  → hits right edge at x=6
 *   up-left    (-1, +1): 3  → hits top edge at y=6; obstacle (4,5) not in path
 *   down-right (+1, -1): 1  → hits right edge at x=6
 *   down-left  (-1, -1): 2  → hits bottom edge at y=1
 *   Total: 15
 */

require_once __DIR__ . '/Point.php';
require_once __DIR__ . '/Comparator.php';
require_once __DIR__ . '/ChessSettings.php';
require_once __DIR__ . '/MoverClass.php';

use queensAttack\Point;
use queensAttack\ChessSettings;
use queensAttack\MoverClass;
use queensAttack\Comparator;

// ─── Minimal test runner ──────────────────────────────────────────────────────
$passed = 0;
$failed = 0;

function t( $name,  $result)
{
    global $passed, $failed;
    if ($result) {
        echo "  [PASS] $name\n";
        $passed++;
    } else {
        echo "  [FAIL] $name\n";
        $failed++;
    }
}

function section( $title)
{
    echo "\n=== $title ===\n";
}

// ─── Comparator::isEqual ─────────────────────────────────────────────────────
section('Comparator::isEqual');
$cmp = new Comparator();

t('equal ints return true',            $cmp->isEqual(5, 5) === true);
t('unequal ints return false',         $cmp->isEqual(3, 7) === false);
t('strict: 0 vs false returns false',  $cmp->isEqual(0, false) === false);
t('strict: 1 vs true returns false',   $cmp->isEqual(1, true) === false);
t('null vs null returns true',         $cmp->isEqual(null, null) === true);

// ─── Point ───────────────────────────────────────────────────────────────────
section('Point');
$p = new Point(4, 7);

t('x is stored correctly',  $p->x === 4);
t('y is stored correctly',  $p->y === 7);

$zero = new Point(0, 0);
t('zero coordinates work',  $zero->x === 0 && $zero->y === 0);

// ─── ChessSettings ───────────────────────────────────────────────────────────
section('ChessSettings initial state');
$cs = new ChessSettings();

t('queen starts at (5,3)',    $cs->queenStartPoint->x === 5 && $cs->queenStartPoint->y === 3);
t('surfCounter starts at 0',  $cs->surfCounter === 0);
t('obstacle 1 at (2,3)',      $cs->obst1->x === 2 && $cs->obst1->y === 3);
t('obstacle 2 at (4,5)',      $cs->obst2->x === 4 && $cs->obst2->y === 5);
t('leftXEdge x = 1',          $cs->leftXEdge->x === 1);
t('rightXEdge x = 6',         $cs->rightXEdge->x === 6);
t('upYedge y = 6',            $cs->upYedge->y === 6);
t('downYedge y = 1',          $cs->downYedge->y === 1);
t('8 x-steps defined',        count($cs->stepsX) === 8);
t('8 y-steps defined',        count($cs->stepsY) === 8);

// ─── MoverClass: individual directions ───────────────────────────────────────
// Each test uses a fresh ChessSettings so surfCounter starts at 0.
section('MoverClass: single directions');

function freshMover()
{
    $cs = new ChessSettings();
    return [$cs, new MoverClass($cs)];
}

// right (+1, 0) → 1 square
[$cs, $mc] = freshMover();
$mc->moveAndCountSingle(1, 0);
t('right (+1,0): 1 square',  $cs->surfCounter === 1);

// left (-1, 0) → 2 squares (blocked by obstacle at (2,3))
[$cs, $mc] = freshMover();
$mc->moveAndCountSingle(-1, 0);
t('left (-1,0): 2 squares',  $cs->surfCounter === 2);

// up (0, +1) → 3 squares
[$cs, $mc] = freshMover();
$mc->moveAndCountSingle(0, 1);
t('up (0,+1): 3 squares',    $cs->surfCounter === 3);

// down (0, -1) → 2 squares
[$cs, $mc] = freshMover();
$mc->moveAndCountSingle(0, -1);
t('down (0,-1): 2 squares',  $cs->surfCounter === 2);

// up-right (+1, +1) → 1 square
[$cs, $mc] = freshMover();
$mc->moveAndCountSingle(1, 1);
t('up-right (+1,+1): 1 square',   $cs->surfCounter === 1);

// up-left (-1, +1) → 3 squares
[$cs, $mc] = freshMover();
$mc->moveAndCountSingle(-1, 1);
t('up-left (-1,+1): 3 squares',   $cs->surfCounter === 3);

// down-right (+1, -1) → 1 square
[$cs, $mc] = freshMover();
$mc->moveAndCountSingle(1, -1);
t('down-right (+1,-1): 1 square', $cs->surfCounter === 1);

// down-left (-1, -1) → 2 squares
[$cs, $mc] = freshMover();
$mc->moveAndCountSingle(-1, -1);
t('down-left (-1,-1): 2 squares', $cs->surfCounter === 2);

// ─── MoverClass: full count ───────────────────────────────────────────────────
section('MoverClass: moveAndCountAll');
$cs = new ChessSettings();
$mc = new MoverClass($cs);
$mc->moveAndCountAll();
t('total reachable squares = 15', $cs->surfCounter === 15);

// ─── Summary ─────────────────────────────────────────────────────────────────
echo "\n" . str_repeat('─', 40) . "\n";
echo "Results: $passed passed, $failed failed\n";

if ($failed > 0) {
    exit(1);
}
