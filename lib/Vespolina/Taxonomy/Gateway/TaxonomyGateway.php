<?php

namespace Vespolina\Taxonomy\Gateway;

use Molino\MolinoInterface;
use Molino\SelectQueryInterface;
use Vespolina\Entity\Taxonomy\TaxonomyInterface;
use Vespolina\Exception\InvalidInterfaceException;

class TaxonomyGateway
{
    protected $molino;
    protected $taxonomyClass;

    /**
     * @param \Molino\MolinoInterface $molino
     * @param string $managedClass
     */
    public function __construct(MolinoInterface $molino, $taxonomyClass)
    {
        if (!class_exists($taxonomyClass) || !in_array('Vespolina\Entity\Taxonomy\TaxonomyInterface', class_implements($taxonomyClass))) {
            throw new InvalidInterfaceException('Please have your taxonomy class implement Vespolina\Entity\Taxonomy\TaxonomyInterface');
        }
        $this->molino = $molino;
        $this->taxonomyClass = $taxonomyClass;
    }

    /**
     * @param string $type
     * @param type $queryClass
     * @return type
     * @throws InvalidArgumentException
     */
    public function createQuery($type, $queryClass = null)
    {
        $type = ucfirst(strtolower($type));
        if (!in_array($type, array('Delete', 'Select', 'Update'))) {
            throw new InvalidArgumentException($type . ' is not a valid Query type');
        }
        $queryFunction = 'create' . $type . 'Query';

        if (!$queryClass) {
            $queryClass = $this->taxonomyClass;
        }
        return $this->molino->$queryFunction($queryClass);
    }

    /**
     * @param \Vespolina\Entity\Taxonomy\TaxonomyInterface $taxonomy
     */
    public function deleteTaxonomy(TaxonomyInterface $taxonomy)
    {
        $this->molino->delete($taxonomy);
    }

    /**
     * @param \Molino\SelectQueryInterface $query
     * @return \Vespolina\Entity\Taxonomy\TaxonomyInterface
     */
    public function findTaxonomy(SelectQueryInterface $query)
    {
        return $query->one();
    }

    /**
     * @param \Molino\SelectQueryInterface $query
     * @return \Vespolina\Entity\Taxonomy\TaxonomyInterface
     */
    public function findTaxonomies(SelectQueryInterface $query)
    {
        return $query->all();
    }

    /**
     * @param \Vespolina\Entity\Taxonomy\TaxonomyInterface $taxonomy
     */
    public function persistTaxonomy(TaxonomyInterface $taxonomy)
    {
        $this->molino->save($taxonomy);
    }

    /**
     * @param \Vespolina\Entity\Taxonomy\TaxonomyInterface $taxonomy
     */
    public function updateTaxonomy(TaxonomyInterface $taxonomy)
    {
        $this->molino->save($taxonomy);
    }
}
