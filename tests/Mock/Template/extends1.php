<?php

declare(strict_types=1);

use TheImp\View\View;

/**
 * @var View $this
 */

$this->extends('extends2');
$this->block('block1');
echo 'Block1';
$this->blockEnd();
