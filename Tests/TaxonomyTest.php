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

        $productTaxonomy->addTerm($productTaxonomy->createTerm('women', 'Women'));
        $productTaxonomy->addTerm($productTaxonomy->createTerm('shoes', 'Shoes'));
    }

    /**
     * @covers Vespolina\TaxonomyBundle\Model\TaxonomyManager::createTaxonomy
     */
    public function testNestedTaxonomyCreate()
    {

        $taxonomyManager = $this->getKernel()->getContainer()->get('vespolina_taxonomy.taxonomy_manager');


        $customerTaxonomy = $taxonomyManager->createTaxonomy('customer_hierarchy', 'nested');

        $customerTaxonomy->addTerm($customerTaxonomy->createTerm('small_companies', 'Small Companies'));
        $customerTaxonomy->addTerm($customerTaxonomy->createTerm('medium_companies', 'Medium Companies'));
        $customerTaxonomy->addTerm($customerTaxonomy->createTerm('big_companies', 'Big Companies'));

        $smallCompaniesTerm = $customerTaxonomy->findTermByPath('small_companies');

        $taxonomyManager->updateTaxonomy($customerTaxonomy);


    }
}