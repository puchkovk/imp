<?php

declare(strict_types=1);

use TheImp\View\View;

/**
 * @var View $this
 */

$this->block('block1');
echo 'Block1 import extendable';
$this->blockEnd();
