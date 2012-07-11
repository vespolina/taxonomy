<?php

namespace Vespolina\TaxonomyBundle\Tests\Manager;

use Vespolina\TaxonomyBundle\Tests\TaxonomyTestCommon;
use Vespolina\TaxonomyBundle\Document\Term;


class TaxonomyTest extends TaxonomyTestCommon
{

    /**
     * @covers Vespolina\TaxonomyBundle\Model\TaxonomyManager::createTaxonomy
     * @covers Vespolina\TaxonomyBundle\Model\TaxonomyManager::createTerm
     */
    public function testTagTaxonomyCreate()
    {

        $taxonomyManager = $this->createTaxonomyManager();

        //Tags (flat) taxonomy

        $productTaxonomy = $taxonomyManager->createTaxonomy('product', 'tags');

        $dressesTerm = $taxonomyManager->createTerm('Women dresses');
        $productTaxonomy->addTerm($dressesTerm);

        $shoesTerm = $taxonomyManager->createTerm('Shoes');
        $productTaxonomy->addTerm($shoesTerm);


        $terms = $productTaxonomy->getTerms();

        $this->assertEquals(count($terms), 2);

        /**
         * Next we associate properties to terms.  This allows us to set default properties to collections associated
         * by a given term
         * Eg.  Products could be associated with the term 'dresses'.  Hence they would share the property 'default_vat'
         * having value 21.
         */
        $dressesTerm->addProperty('default_vat', 21);
        $dressesTerm->addProperty('default_shipping_method', 'cash_on_delivery');

        $shoesTerm->addProperty('default_vat', 20);
        $shoesTerm->addProperty('default_shipping_method', '24h_delivery');

        $this->assertEquals(count($productTaxonomy->getTerms()), 2);

        foreach($productTaxonomy->getTerms() as $term) {
            if ($term->getName() == 'dresses') {
                $this->assertEquals(count($term->getProperties()), 2);
            }
        }


    }

}