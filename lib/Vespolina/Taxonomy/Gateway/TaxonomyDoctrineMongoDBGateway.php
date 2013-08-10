<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Taxonomy\Gateway;

use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;
use Vespolina\Exception\InvalidInterfaceException;
use Vespolina\Taxonomy\Gateway\TaxonomyGateway;
use Vespolina\Specification\SpecificationInterface;

class TaxonomyDoctrineMongoDBGateway extends TaxonomyGateway
{
    protected $dm;
    protected $taxonomyNodeClass;

    public function __construct($documentManager, $taxonomyNodeClass)
    {
        parent::__construct($taxonomyNodeClass, 'DoctrineMongoDB');
        $this->dm = $documentManager;
    }

    public function createQuery()
    {
        return $this->dm->createQueryBuilder($this->taxonomyNodeClass);
    }

    /**
     * @param \Vespolina\Entity\Taxonomy\TaxonomyNodeInterface $taxonomyNode
     */
    public function deleteTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = false)
    {
        $this->dm->remove($taxonomyNode);
    }

    protected function executeSpecification(SpecificationInterface $specification, $matchOne = false)
    {
        $repo = $this->dm->getRepository($this->taxonomyNodeClass);

        //Todo: add a specification walker
        //$this->getSpecificationWalker()->walk($specification, $queryBuilder);

        $queryBuilder = $repo->getChildrenQueryBuilder(null);

        //Construct a materialized child query for the current taxonomy node (each root node of the collection is a different taxonomy)
        $queryBuilder
            ->field('path')->equals(new \MongoRegex(preg_quote($specification->getTaxonomyName()).'.+/'))
            ->field('level')->gt(1);    //Level = taxonomy name

        $taxonomyName = $specification->getTaxonomyName();

        $query = $queryBuilder->getQuery();

        if ($matchOne) {

            return $query->getSingleResult();
        } else {

            return $query->execute();
        }
    }

    public function matchTaxonomyNode($specification)
    {
        return $this->executeSpecification($specification, true);
    }

    public function matchAll($specification)
    {
        return $this->executeSpecification($specification);
    }

    /**
     * @param \Vespolina\Entity\Taxonomy\TaxonomyNodeInterface $taxonomy
     */
    public function persistTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = false)
    {
        $this->dm->persist($taxonomyNode);
        if ($andFlush) $this->flush();
    }

    /**
     * @param \Vespolina\Entity\Taxonomy\TaxonomyNodeInterface $taxonomy
     */
    public function updateTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = false)
    {
        $level = $taxonomyNode->getLevel();

        if (null == $level) {
            $level = 0;

            if (null !== $parent = $taxonomyNode->getParent()) {
                $level = $parent->getLevel() + 1;
            }

            $rp = new \ReflectionProperty($taxonomyNode, 'level');
            $rp->setAccessible(true);
            $rp->setValue($taxonomyNode, $level);
            $rp->setAccessible(false);
        }

        $this->dm->persist($taxonomyNode);
        if ($andFlush) $this->flush();
    }

    public function flush()
    {
        $this->dm->flush();
    }
}
