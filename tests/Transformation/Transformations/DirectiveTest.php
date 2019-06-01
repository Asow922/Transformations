<?php


namespace App\Tests\Transformation\Transformations;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;
use App\Metamodel\Model\Text;
use App\Transformation\Transformations\DirectiveMap;
use App\Transformation\Transformations\DirectiveNgOn;
use App\Transformation\Transformations\DirectiveNgProp;
use App\Transformation\Transformations\DirectiveNgSrcset;
use App\Transformation\Transformations\DirectiveRemove;
use App\Transformation\Transformations\DirectiveShow;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DirectiveTest extends KernelTestCase
{
    public function testDirectiveMap()
    {
        self::bootKernel();

        $directive = new DirectiveMap();

        foreach (DirectiveMap::$map as $item => $need) {
            $attribute = new Attribute();
            $attribute->setName($item);
            $directive->translate($attribute, new Root());

            $this->assertEquals($attribute->getName(), $need);
        }
    }

    public function testDirectiveRemove()
    {
        self::bootKernel();

        $directive = new DirectiveRemove();

        foreach (DirectiveRemove::$toRemove as $item => $need) {
            $root = new Root();
            $root->addAttribute(new Attribute());
            $attribute = new Attribute();
            $attribute->setName($item);
            $root->addAttribute($attribute);
            $root->addAttribute(new Attribute());
            $directive->translate($attribute, $root);

            $this->assertEquals(count($root->getAttributes()), 2);
            foreach ($root->getAttributes() as $attributeIn) {
                $this->assertNotEquals($attribute, $attributeIn);
            }
        }
    }

    public function testDirectiveNgOn()
    {
        self::bootKernel();

        $directive = new DirectiveNgOn();

        $directiveToTest = [
            'ng-on-click' => '(click)',
            'ng-on-mouseover' => '(mouseover)',
            'ng-on-change' => '(change)',
            'ng-on-submit' => '(submit)',
            'ng-on-keyup' => '(keyup)',
            'ng-on-blur' => '(blur)',
            'ng-on-focus' => '(focus)',
        ];

        foreach ($directiveToTest as $item => $need) {
            $attribute = new Attribute();
            $attribute->setName($item);
            $directive->translate($attribute, new Root());

            $this->assertEquals($attribute->getName(), $need);
        }
    }

    public function testDirectiveNgProp()
    {
        self::bootKernel();

        $directive = new DirectiveNgProp();

        $directiveToTest = [
            'ng-prop-inner_h_t_m_l' => '[innerHTML]',
            'ng-prop-inner_text' => '[innerText]',
            'ng-prop-id' => '[id]',
            'ng-prop-color' => '[color]',
        ];

        foreach ($directiveToTest as $item => $need) {
            $attribute = new Attribute();
            $attribute->setName($item);
            $directive->translate($attribute, new Root());

            $this->assertEquals($attribute->getName(), $need);
        }
    }

    public function testDirectiveNgSrcset()
    {
        self::bootKernel();

        $directive = new DirectiveNgSrcset();

        $root = new Root();
        $attribute = new Attribute();
        $attribute->setName('ng-srcset');
        $attribute->addExpression(new Text('img1 2x, img2 3x, img3 4x'));
        $root->addAttribute($attribute);

        $directive->translate($attribute, $root);

        $this->assertEquals(count($root->getAttributes()), 2);

        foreach ($root->getAttributes() as $attribute) {
            if ($attribute->getName() == '[src]') {
                $this->assertEquals($attribute->getName(), '[src]');
                $this->assertEquals((string)$attribute->getExpressions()[0], 'img1 2x');
            } else {
                $this->assertEquals($attribute->getName(), 'srcset');
            }
        }
    }

    public function testDirectiveShow()
    {
        self::bootKernel();

        $directive = new DirectiveShow();

        $attribute = new Attribute();
        $attribute->setName('ng-show');
        $attribute->addExpression(new Text('value'));

        $directive->translate($attribute, new Root());

        $this->assertEquals($attribute->getName(), '[hidden]');
        $this->assertEquals(count($attribute->getExpressions()), 3);

        $text = '';
        foreach ($attribute->getExpressions() as $one) {
            $text .= $one;
        }

        $this->assertContains('!(', $text);
        $this->assertContains('value', $text);
        $this->assertContains(')', $text);
    }
}