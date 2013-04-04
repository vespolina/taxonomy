<?php

use Vespolina\Taxonomy\Manager\TaxonomyManager;
use Vespolina\Taxonomy\Util\TaxonomyManipulator;

class TaxonomyManipulatorTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromFlatArray()
    {
        $manipulator = $this->createTaxonomyManipulator();
        $flatArray = array('a', 'b', 'c');
        $nodes = $manipulator->createTaxonomyNodesFromArray($flatArray);

        $this->assertEquals(count($flatArray), count($nodes));
    }

    public function testCreateFromNestedArray()
    {
        $manipulator = $this->createTaxonomyManipulator();
        $nestedArray = array('a' => array('a1', 'a2'), 'b' => array('b1','b2'));

        $nodes = $manipulator->createTaxonomyNodesFromArray($nestedArray);

        $this->assertEquals(count($nestedArray), count($nodes));
    }

    protected function createTaxonomyManipulator()
    {
        $taxonomyGateway = $this->getMockBuilder('Vespolina\Taxonomy\Gateway\TaxonomyGatewayInterface')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $taxonomyManager = new TaxonomyManager($taxonomyGateway, 'Vespolina\Entity\Taxonomy\TaxonomyNode');

        return new TaxonomyManipulator($taxonomyManager);
    }
}
