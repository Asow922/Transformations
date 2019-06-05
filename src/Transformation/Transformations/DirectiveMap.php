<?php


namespace App\Transformation\Transformations;


use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;

class DirectiveMap extends Directive
{
    public static $map = [
        'ng-href' => '[href]',
        'ng-src' => '[src]',
        'ng-disabled' => '[disabled]',
        'ng-checked' => '[checked]',
        'ng-readonly' => '[readonly]',
        'ng-selected' => '[selected]',
        'ng-form' => '[ngForm]',
        'ng-value' => '[value]',
        'ng-bind' => '[textContent]',
        'ng-bing-template' => '[innerHTML]',
        'ng-bind-html' => '[innerHTML]',
        'ng-change' => '(change)',
        'ng-class' => '[ngClass]',
        'ng-style' => '[ngStyle]',
        'ng-click' => '(click)',
        'ng-dblclick' => '(dblclick)',
        'ng-mousedown' => '(mousedown)',
        'ng-mouseup' => '(mouseup)',
        'ng-mouseover' => '(mouseover)',
        'ng-mouseenter' => '(mouseneeter)',
        'ng-mouseleave' => '(mouseleav)',
        'ng-mousemove' => '(mousemove)',
        'ng-keydown' => '(keydown)',
        'ng-keyup' => '(keyup)',
        'ng-keypress' => '(keypress)',
        'ng-submit' => '(submit)',
        'ng-focus' => '(focus)',
        'ng-blur' => '(blur)',
        'ng-copy' => '(copy)',
        'ng-cut' => '(cut)',
        'ng-paste' => '(paste)',
        'ng-if' => '*ngIf',
        'ng-init' => '[ngInit]',
        'ng-model' => '[(ngModel)]',
        'ng-model-options' => '[ngModelOptions]',
        'ng-non-bindable' => 'ngNonBindable',
        'ng-pluralize' => 'ngPlural',
//        'ng-repeat' => '*ngFor',
        'ng-hide' => '[hidden]',
        'ng-switch' => '[ngSwitch]',
        'ng-transclude' => 'ng-content',
        'ng-required' => '[required]',
        'ng-pattern' => 'pattern',
        'ng-maxlength' => 'maxlength',
        'ng-minlength' => 'minlength'
    ];

    /**
     * @param Attribute $attribute
     * @param Root $model
     * @return bool
     */
    public static function translate(Attribute $attribute, Root $model): bool
    {
        $directive = self::getDirectiveName($attribute);
        if (isset(self::$map[$directive])) {
            $attribute->setName(self::$map[$directive]);
            return true;
        }

        return false;
    }
}