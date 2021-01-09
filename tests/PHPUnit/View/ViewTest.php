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

    public function testExtends(): void
    {
        $tplRoot = __DIR__ . '/../../Mock/Template';
        $view = new View();
        $view->setTemplateRoot($tplRoot);
        ob_start();
        $result = $view->render('extends1');
        $output = ob_get_clean();
        $this->assertSame('Block1Block2 extends2', $result);
    }

    public function testExtendsWithVars(): void
    {
        $tplRoot = __DIR__ . '/../../Mock/Template';
        $view = new View();
        $view->setTemplateRoot($tplRoot);
        $params = [
            'one' => 1,
            'two' => 2,
        ];

        $result = $view->render('extends3', $params);

        $this->assertSame('Block1 var 1Block2 extends2 var 2', $result);
    }
}
