<?php

declare(strict_types=1);

namespace TheImp\Tests\PHPUnit\View;

use PHPUnit\Framework\TestCase;
use TheImp\View\View;
use TheImp\View\ViewException;

class ViewTest extends TestCase
{

    public function testBasicUsage(): void
    {
        $tplRoot = __DIR__ . '/../../Mock/Template';
        $view = new View();
        $view->setTemplateRoot($tplRoot);
        $file = file_get_contents($tplRoot . '/basic.php');

        $this->assertSame($file, $view->render('basic'));
    }

    public function testNoTemplate(): void
    {
        $tplRoot = __DIR__ . '/../../Mock/Template';
        $view = new View();
        $view->setTemplateRoot($tplRoot);
        $this->expectException(ViewException::class);

        $view->render('notexistent');
    }

    public function testSimpleParam(): void
    {
        $tplRoot = __DIR__ . '/../../Mock/Template';
        $view = new View();
        $view->setTemplateRoot($tplRoot);
        $paramTest = 'My test param';
        $view->setParam('test', $paramTest);
        $this->assertSame($paramTest, $view->render('param1'));
    }

    public function testGlobalParam(): void
    {
        $tplRoot = __DIR__ . '/../../Mock/Template';
        $paramTest = 'My global param';
        View::setGlobal('globalTest', $paramTest);
        $view = new View();
        $view->setTemplateRoot($tplRoot);
        $this->assertSame($paramTest, $view->render('global'));
    }

    public function testSetGetParam(): void
    {
        $tplRoot = __DIR__ . '/../../Mock/Template';
        $view = new View();
        $view->setTemplateRoot($tplRoot);
        $paramTest = 'My test param';
        $view->setParam('test', $paramTest);
        $this->assertSame($paramTest, $view->getParam('test'));
    }

    public function testSetGetParams(): void
    {
        $tplRoot = __DIR__ . '/../../Mock/Template';
        $view = new View();
        $view->setTemplateRoot($tplRoot);
        $paramsTest = ['testTest' => 'My test param'];
        $view->setParams($paramsTest);
        $this->assertSame($paramsTest, $view->getParams());
    }
}
