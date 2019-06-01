<?php

namespace App\Metamodel\Services;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;
use App\Metamodel\Model\Text;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GenerateMetamodelServiceTest extends KernelTestCase
{

    public function testSimpleHtmlGenerate()
    {
        self::bootKernel();
        $container = self::$container;

        $html = <<<'HTML'
                <!DOCTYPE html>
                <html>
                    <body>
                    </body>
                </html>
HTML;

        $test = new Root();
        $test->setName('html');
        $body = new Root();
        $body->setName('body');
        $test->addLeaf($body);

        $result = $container->get(GenerateMetamodelService::class)->generate($html);

        $this->assertEquals($test, $result);
    }

    public function testAttributeHtmlGenerate()
    {
        self::bootKernel();
        $container = self::$container;

        $html = <<<'HTML'
                <!DOCTYPE html>
                <html attr="test">
                    <body attr="test" class="class1">
                    </body>
                </html>
HTML;

        $test = new Root();
        $test->setName('html');
        $rootAttr = new Attribute();
        $rootAttr->setName('attr');
        $rootAttr->addExpression(new Text('test'));
        $test->addAttribute($rootAttr);
        $body = new Root();
        $body->setName('body');

        $rootAttr = new Attribute();
        $rootAttr->setName('attr');
        $rootAttr->addExpression(new Text('test'));
        $body->addAttribute($rootAttr);

        $rootAttr = new Attribute();
        $rootAttr->setName('class');
        $rootAttr->addExpression(new Text('class1'));
        $body->addAttribute($rootAttr);

        $test->addLeaf($body);

        $result = $container->get(GenerateMetamodelService::class)->generate($html);

        $this->assertEquals($test, $result);
    }

    public function testTextInHtmlGenerate()
    {
        self::bootKernel();
        $container = self::$container;

        $html = <<<'HTML'
                <!DOCTYPE html>
                <html attr="test">
                    <body attr="test" class="class1">
                        line 1
                        <span>Line 2</span>
                        line 3
                        <span>Line 4</span>
                        <span>Line 5</span>
                        line 6
                    </body>
                </html>
HTML;

        $test = new Root();
        $test->setName('html');
        $rootAttr = new Attribute();
        $rootAttr->setName('attr');
        $rootAttr->addExpression(new Text('test'));
        $test->addAttribute($rootAttr);

        $body = new Root();
        $body->setName('body');

        $rootAttr = new Attribute();
        $rootAttr->setName('attr');
        $rootAttr->addExpression(new Text('test'));
        $body->addAttribute($rootAttr);

        $rootAttr = new Attribute();
        $rootAttr->setName('class');
        $rootAttr->addExpression(new Text('class1'));
        $body->addAttribute($rootAttr);

        $textRoot = new Root();
        $textRoot->setName('__text');
        $textRoot->addExpression(new Text('line 1'));
        $body->addLeaf($textRoot);

        $spanRoot = new Root();
        $spanRoot->setName('span');

        $textRoot = new Root();
        $textRoot->setName('__text');
        $textRoot->addExpression(new Text('Line 2'));
        $spanRoot->addLeaf($textRoot);

        $body->addLeaf($spanRoot);

        $textRoot = new Root();
        $textRoot->setName('__text');
        $textRoot->addExpression(new Text('line 3'));
        $body->addLeaf($textRoot);

        $spanRoot = new Root();
        $spanRoot->setName('span');

        $textRoot = new Root();
        $textRoot->setName('__text');
        $textRoot->addExpression(new Text('Line 4'));
        $spanRoot->addLeaf($textRoot);

        $body->addLeaf($spanRoot);

        $spanRoot = new Root();
        $spanRoot->setName('span');

        $textRoot = new Root();
        $textRoot->setName('__text');
        $textRoot->addExpression(new Text('Line 5'));
        $spanRoot->addLeaf($textRoot);

        $body->addLeaf($spanRoot);

        $textRoot = new Root();
        $textRoot->setName('__text');
        $textRoot->addExpression(new Text('line 6'));
        $body->addLeaf($textRoot);

        $test->addLeaf($body);

        $result = $container->get(GenerateMetamodelService::class)->generate($html);

        $this->assertEquals($test, $result);
    }
}
