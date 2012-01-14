<?php

namespace Vespolina\TaxonomyBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\TaxonomyBundle\Document\NestedTerm;
use Vespolina\TaxonomyBundle\Document\Term;


class TaxonomyTest extends WebTestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = $this->createClient();
    }

    public function getKernel(array $options = array())
    {
        if (!self::$kernel) {
            self::$kernel = $this->createKernel($options);
            self::$kernel->boot();
        }

        return self::$kernel;
    }

    /**
     * @covers Vespolina\TaxonomyBundle\Model\TaxonoyManager::createTaxonomy
     */
    public function testTagTaxonomyCreate()
    {

        $taxonomyManager = $this->getKernel()->getContainer()->get('vespolina_taxonomy.taxonomy_manager');

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

        $taxonomyManager->updateTaxonomy($productTaxonomy);


        //Retrieve the taxonomy we just created
        $aProductTaxonomy = $taxonomyManager->findTaxonomyById('product');
        $this->assertNotNull($aProductTaxonomy);
        $this->assertEquals(count($aProductTaxonomy->getTerms()), 2);

        foreach($aProductTaxonomy->getTerms() as $term) {
            if ($term->getName() == 'dresses') {
                $this->assertEquals(count($term->getProperties()), 2);
            }
        }


    }

}