<?php
/**
 * @var \TheImp\View\View $this
 * @var int $one
 * @var int $two
 */
$this->extends('extends4');
$this->block('block1');
echo 'Block1 var ' . $one;
$this->blockEnd();
