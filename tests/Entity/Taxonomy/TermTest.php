<?php

use Vespolina\Entity\Taxonomy\Term;

class TestTerm extends \PHPUnit_Framework_TestCase
{
    public function testChildren()
    {
        $rootTerm = new Term('root');
        $this->assertNull($rootTerm->getChildren(), 'make sure we start out empty');

        $child = new Term('child');
        $rootTerm->addChild($child);
        $this->assertContains($child, $rootTerm->getChildren());
        $this->assertCount(1, $rootTerm->getChildren());
        $this->assertSame($rootTerm, $child->getParent());

        $children = array();
        $children[0] = new Term('child0');
        $children[1] = new Term('child1');
        $rootTerm->addChildren($children);
        $this->assertCount(3, $rootTerm->getChildren());
        $this->assertContains($children[0], $rootTerm->getChildren());
        $this->assertContains($children[1], $rootTerm->getChildren());
        $this->assertSame($rootTerm, $children[0]->getParent());
        $this->assertSame($rootTerm, $children[1]->getParent());

        $rootTerm->removeChild($child);
        $this->assertNotContains($child, $rootTerm->getChildren());
        $this->assertCount(2, $rootTerm->getChildren());
        $this->assertNull($child->getParent());

        $rootTerm->clearChildren();
        $this->assertEmpty($rootTerm->getChildren());
        $this->assertNull($children[0]->getParent());
        $this->assertNull($children[1]->getParent());

        $rootTerm->addChild($child);
        $rootTerm->setChildren($children);
        $this->assertNotContains($child, $rootTerm->getChildren(), 'this should have been removed on setting a new array of items');
        $this->assertCount(2, $rootTerm->getChildren());
        $this->assertContains($children[0], $rootTerm->getChildren());
        $this->assertContains($children[1], $rootTerm->getChildren());
        $this->assertSame($rootTerm, $children[0]->getParent());
        $this->assertSame($rootTerm, $children[1]->getParent());
    }
}
