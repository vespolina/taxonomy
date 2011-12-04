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

        $productTaxonomy = $taxonomyManager->createTaxonomy('product_tags', 'tags');

        $productTaxonomy->addTerm(new Term('women'));
        $productTaxonomy->addTerm(new Term('shoes'));
    }

    /**
     * @covers Vespolina\TaxonomyBundle\Model\TaxonoyManager::createTaxonomy
     */
    public function testNestedTaxonomyCreate()
    {

        $taxonomyManager = $this->getKernel()->getContainer()->get('vespolina_taxonomy.taxonomy_manager');


        $customerTaxonomy = $taxonomyManager->createTaxonomy('customer_hierarchy', 'nested');

        $customerTaxonomy->addTerm(new NestedTerm('small_companies'));
        $customerTaxonomy->addTerm(new NestedTerm('medium_companies'));
        $customerTaxonomy->addTerm(new NestedTerm('big_companies'));
        $customerTaxonomy->addTerm(new NestedTerm('huge_companies'));


        $smallCompaniesTerm = $customerTaxonomy->findTermByPath('small_companies');




        $taxonomyManager->updateTaxonomy($customerTaxonomy);


    }
}