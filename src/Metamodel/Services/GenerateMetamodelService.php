<?php

namespace App\Metamodel\Services;

use App\Metamodel\Model\Attribute;
use App\Metamodel\Model\Root;
use App\Metamodel\Model\Text;
use DOMAttr;
use DOMElement;
use Exception;
use Symfony\Component\DomCrawler\Crawler;

class GenerateMetamodelService
{
    public function generate($html)
    {
        $crawler = new Crawler($html);
        $AST = $this->createNewRoot($crawler);
        $this->extractCurrent($crawler, $AST);

        return $AST;
    }

    protected function extractCurrent(Crawler $crawler, Root $parent = null)
    {
        if (!$crawler->children()->count()) {
            $this->checkTextBetweenChild($crawler, $parent, 0);
            return;
        }

        $crawler->children()->each(function (Crawler $child, $id) use ($parent, $crawler) {
            $this->checkTextBetweenChild($crawler, $parent, $id);
            $newRoot = $this->createNewRoot($child, $parent);
            $this->checkLastText($crawler, $parent, $id);
            $this->extractCurrent($child, $newRoot);
        });
    }

    protected function checkLastText(Crawler $crawler, Root $parent, $id)
    {
        if (($id + 1) == $crawler->children()->count() && $crawler->children()->count() > $id && $crawler->children()->getNode($id)) {
            $text = trim($crawler->html());
            $text = explode($crawler->children()->getNode($id)->ownerDocument->saveHTML($crawler->children()->getNode($id)), $text);
            $text = trim($text[count($text) - 1]);

            $this->addTextToParent($text, $parent);
        }
    }

    protected function checkTextBetweenChild(Crawler $crawler, Root $parent, $id)
    {
        $text = trim($crawler->html());
        if ($id == 0) {
            if ($crawler->children()->count() > $id && $crawler->children()->getNode($id)) {
                $text = trim(explode($crawler->children()->getNode(0)->ownerDocument->saveHTML($crawler->children()->getNode(0)), $text)[0]);
            }
        } elseif ($crawler->children()->getNode($id) && $crawler->children()->getNode($id - 1)) {
            $first = $crawler->children()->getNode($id - 1)->ownerDocument->saveHTML($crawler->children()->getNode($id - 1));
            $last = $crawler->children()->getNode($id)->ownerDocument->saveHTML($crawler->children()->getNode($id));
            if ($first && $last) {
                $text = explode($first, $text)[1];
                $text = explode($last, $text)[0];
                $text = trim($text);
            }
        }

        $this->addTextToParent($text, $parent);
    }

    protected function addTextToParent($text, Root $parent)
    {
        if ($text != '') {
            $textRoot = new Root();
            $textRoot->setName('__text');
            $textRoot->addExpression(new Text($text));
            $parent->addLeaf($textRoot);
        }
    }

    protected function createNewRoot(Crawler $crawler, Root $parent = null)
    {
        $newRoot = new Root();
        $newRoot->setName($crawler->nodeName());
        $this->createAttributeList($crawler, $newRoot);
        if ($parent) {
            $parent->addLeaf($newRoot);
        }

        return $newRoot;
    }

    protected function createAttributeList(Crawler $crawler, Root $root)
    {
        if ($crawler->count() > 1) {
            throw new Exception('Nieprzewidziana sytuacja!!');
        }

        /** @var DOMElement $attribute */
        foreach ($crawler->getNode(0)->attributes as $attribute) {
            $newAttribute = new Attribute();
            $newAttribute->setName($attribute->nodeName);
            $this->createAttributeValue($attribute, $newAttribute);
            $root->addAttribute($newAttribute);
        }
    }

    protected function createAttributeValue(DOMAttr $DOMElement, Attribute $attribute)
    {
        $attribute->addExpression(new Text($DOMElement->nodeValue));
    }
}