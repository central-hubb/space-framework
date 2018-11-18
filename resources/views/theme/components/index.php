<?php

use App\Library\Framework\Component\Panel;
use App\Library\Framework\Component\Form\AutoComplete;
use App\Library\Framework\Component\Form\PasswordShowHide;

// panel: example
$panel = new Panel();
$panel->setTitle('Panel')->setContent('example panel');
echo $panel->getHtml();

// input: auto complete
$autoComplete = new AutoComplete();
$autoComplete->setDataSource('/api/component/auto-complete/demo1');
$panel = new Panel();
$panel->setTitle('Input: Auto Complete')->setContent($autoComplete->getHtml());
echo $panel->getHtml();

// input: password show / hide
$passwordShowHide = new PasswordShowHide();
$panel = new Panel();
$panel->setTitle('Input: Password Show / Hide')->setContent($passwordShowHide->getHtml());
echo $panel->getHtml();

// input : panel 4
$panel3 = new Panel();
$panel3->setTitle('Panel 4')->setContent('content4');
echo $panel3->getHtml();
