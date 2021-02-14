<?php

declare(strict_types=1);

use TheImp\View\View;

/**
 * @var View $this
 */

$this->extends('import_extendable');
$this->block('block1');
?>
We will import: <?php

echo $this->render('imported', ['a' => 'AA']);

$this->blockEnd();
