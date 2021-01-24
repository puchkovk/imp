<?php

declare(strict_types=1);

use TheImp\View\View;

/**
 * @var View $this
 *
 * @var int $two
 */
$this->block('block1');
echo 'Block1 extends2';
$this->blockEnd();

$this->block('block2');
echo 'Block2 extends2 var ' . $two;
$this->blockEnd();