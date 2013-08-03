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

class TaxonomyPHPCRGateway extends TaxonomyGateway
{
    protected $dm;
    protected $taxonomyNodeClass;

    public function __construct($documentManager, $taxonomyNodeClass, $rootPath = '/')
    {
        parent::__construct($taxonomyNodeClass, 'DoctrinePHPCR');
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
        $queryBuilder = $this->createQuery();
        $this->getSpecificationWalker()->walk($specification, $queryBuilder);
        $query = $queryBuilder->getQuery();

        if ($matchOne) {

            return $query->getSingleResult();
        } else {

            return $query->execute();
        }
    }

    public function matchTaxonomyNode($specification)
    {
    }

    public function matchAll($specification)
    {
    }

    /**
     * @return \Vespolina\Entity\Taxonomy\TaxonomyNodeInterface
     */
    public function findTaxonomyNodes(SelectQueryInterface $query)
    {
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
        $this->dm->persist($taxonomyNode);
        if ($andFlush) $this->flush();
    }

    public function flush()
    {
        $this->dm->flush();
    }
}
