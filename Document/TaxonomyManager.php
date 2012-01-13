<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\TaxonomyBundle\Document;

use Doctrine\ODM\MongoDB\DocumentManager;
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
    protected $taxonomyRepo;
    
    public function __construct(DocumentManager $dm, $nestedTaxonomyClass, $tagTaxonomyClass)
    {

        $this->dm = $dm;
        $this->taxonomyRepo = $this->dm->getRepository($tagTaxonomyClass);

        parent::__construct($nestedTaxonomyClass, $tagTaxonomyClass);

    }



    /**
     * @inheritdoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->taxonomyRepo->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritdoc
     */
    public function findTaxonomyById($id)
    {

        return $this->taxonomyRepo->find($id);
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
