<?php
/**
 * (c) 2012-2013 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Taxonomy\Manager;

use Vespolina\Entity\Taxonomy\TaxonomyInterface;
use Vespolina\Taxonomy\Gateway\TaxonomyGateway;
use Vespolina\Exception\InvalidConfigurationException;

/**
 * TaxonomyManager - handles taxonomy creation, updating, deletion, etc
 *
 */
class TaxonomyManager
{
    protected $gateway;
    protected $taxonomyClass;

    /**
     * Constructor to setup the taxonomy manager
     *
     * @param \Vespolina\Taxonomy\Gateway\TaxonomyGateway $gateway
     * @param string $taxonomyClass
     * @throws InvalidConfigurationException
     */
    public function __construct(TaxonomyGateway $gateway, $taxonomyClass)
    {
        $this->gateway = $gateway;

        if (!class_exists($taxonomyClass)) {
            throw new InvalidConfigurationException(sprintf("Class '%s' not found.", $taxonomyClass));
        }
        $this->taxonomyClass = $taxonomyClass;
    }

    /**
     * {@inheritdoc}
     */
    public function createTaxonomy()
    {
        /* @var $taxonomy TaxonomyInterface */
        $taxonomy = new $this->taxonomyClass;

        return $taxonomy;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteTaxonomy(TaxonomyInterface $taxonomy, $andFlush = true)
    {
        $this->gateway->deleteTaxonomy($taxonomy);
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $query = $this->gateway->createQuery('Select');
        $query->filterEqual('id', $id);

        return $this->gateway->findTaxonomy($query);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByTaxonomyId($taxonomyId)
    {
        $query = $this->gateway->createQuery('Select');
        $query->filterEqual('taxonomyId', $taxonomyId);

        return $this->gateway->findTaxonomy($query);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        $query = $this->gateway->createQuery('Select');

        return $this->gateway->findTaxonomies($query);
    }

    /**
     * {@inheritdoc}
     */
    public function updateTaxonomy(TaxonomyInterface $taxonomy, $andFlush = true)
    {
        $this->gateway->updateTaxonomy($taxonomy);
    }
}
