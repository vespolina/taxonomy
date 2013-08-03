<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\TaxonomyBundle\Tests;

abstract class TaxonomyTestCommon extends \PHPUnit_Framework_TestCase
{

    public function createTaxonomyManager()
    {
            return
                $this->getMockForAbstractClass('Vespolina\Entity\Taxonomy\TaxonomyManager',
                array(
                		'Vespolina\TaxonomyBundle\Document\Taxonomy',
                        'Vespolina\TaxonomyBundle\Document\Term'
                ));
    }
}