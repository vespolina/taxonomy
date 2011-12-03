<?php

namespace Vespolina\TaxonomyBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
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


        $taxonomy = $taxonomyManager->createTaxonomy('product_tags', 'tags');

        $taxonomy->addTerm(new Term('women'));
        $taxonomy->addTerm(new Term('shoes'));


        $taxonomyManager->updateTaxonomy($taxonomy);

        
    }
}