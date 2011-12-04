<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\TaxonomyBundle\Document;

use Symfony\Component\DependencyInjection\Container;

use Vespolina\TaxonomyBundle\Document\NestedTaxonomy;
use Vespolina\TaxonomyBundle\Document\TagTaxonomy;
use Vespolina\TaxonomyBundle\Model\TaxonomyInterface;
use Vespolina\TaxonomyBundle\Model\TaxonomyManager as BaseTaxonomyManager;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 * @author Richard Shank <develop@zestic.com>
 */
class TaxonomyManager extends BaseTaxonomyManager
{
    protected $dm;
    protected $primaryIdentifier;
    protected $salesTaxonomyRepo;
    
    public function __construct(Container $container)
    {
        $this->dm = $container->get('doctrine.odm.mongodb.default_document_manager');
        //$this->salesTaxonomyRepo = $this->dm->getRepository('Vespolina\TaxonomyBundle\Document\Taxonomy'); // TODO make configurable

        parent::__construct($container);
    }

    /**
     * @inheritdoc
     */
    public function createTaxonomy($name, $type)
    {
        //TODO: Factory
        $taxonomy = null;

        switch ($type) {

            case 'nested';

                $taxonomy = new NestedTaxonomy();
                break;

            case 'tags':

                $taxonomy = new TagTaxonomy();
                break;
        }

        if ($taxonomy) {

            $taxonomy->setName($name);
            $taxonomy->setType($type);
        }

        return $taxonomy;
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->TaxonomyRepo->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritdoc
     */
    public function findTaxonomyById($id)
    {

        return $this->TaxonomyRepo->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findTaxonomyByIdentifier($name, $code)
    {

    }

    /**
     * @inheritdoc
     */
    public function updateTaxonomy(TaxonomyInterface $Taxonomy, $andFlush = true)
    {
        $this->dm->persist($Taxonomy);
        if ($andFlush) {
            $this->dm->flush();
        }
    }
}
