<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\Taxonomy\Manager;

use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;
use Vespolina\Taxonomy\Gateway\TaxonomyGatewayInterface;
use Vespolina\Taxonomy\Manager\TaxonomyManagerInterface;
use Vespolina\Exception\InvalidConfigurationException;

/**
 * TaxonomyManager - handles taxonomy creation, updating, deletion, etc
 *
 * @author Jarrett Croll <jarrett.croll@gmail.com>
 */
class TaxonomyManager implements TaxonomyManagerInterface
{
    protected $gateway;
    protected $taxonomyNodeClass;

    /**
     * Constructor to setup the taxonomy manager
     *
     * @param \Vespolina\Taxonomy\Gateway\TaxonomyGatewayInterface $gateway
     * @param string $taxonomyNodeClass
     * @throws InvalidConfigurationException
     */
    public function __construct(TaxonomyGatewayInterface $gateway, $taxonomyNodeClass)
    {
        $this->gateway = $gateway;

        if (!class_exists($taxonomyNodeClass)) {
            throw new InvalidConfigurationException(sprintf("Class '%s' not found.", $taxonomyNodeClass));
        }
        $this->taxonomyNodeClass = $taxonomyNodeClass;
    }

    /**
     * {@inheritdoc}
     */
    public function createTaxonomyNode($name, $parent = null)
    {
        /* @var $taxonomyNode TaxonomyNodeInterface */
        $taxonomyNode = new $this->taxonomyNodeClass;
        $taxonomyNode->setName($name);

        if (null != $parent) {
            $taxonomyNode->setParent($parent);
        }

        return $taxonomyNode;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = true)
    {
        $this->gateway->deleteTaxonomyNode($taxonomyNode);
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $query = $this->gateway->createQuery('Select');
        $query->filterEqual('id', $id);

        return $this->gateway->findTaxonomyNode($query);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByTaxonomyNodeId($id)
    {
        $query = $this->gateway->createQuery('Select');
        $query->filterEqual('id', $id);

        return $this->gateway->findTaxonomyNode($query);
    }

    /**
     * {@inheritdoc}
     */
    public function findAllWithParentId($parentId)
    {
        $query = $this->gateway->createQuery('Select');
        $query->filterEqual('parent', $parentId);

        return $this->gateway->findTaxonomyNodes($query);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        $query = $this->gateway->createQuery('Select');

        return $this->gateway->findTaxonomyNodes($query);
    }

    public function matchAll($specification)
    {
        return $this->gateway->matchAll($specification);
    }

    /**
     * {@inheritdoc}
     */
    public function updateTaxonomyNode(TaxonomyNodeInterface $taxonomyNode, $andFlush = true)
    {
        $this->gateway->updateTaxonomyNode($taxonomyNode);
    }
}
