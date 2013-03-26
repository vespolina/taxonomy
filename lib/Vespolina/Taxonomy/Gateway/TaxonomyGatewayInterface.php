<?php

namespace Vespolina\Taxanomy\Gateway;

use Molino\SelectQueryInterface;
use Vespolina\Entity\Taxanomy\TaxanomyInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
interface TaxanomyGatewayInterface
{
    /**
     * Delete a Taxanomy that has been persisted and optionally flush that link.
     * Systems that allow for a delayed flush can use the $andFlush parameter, other
     * systems would disregard the flag. The success of the process is returned.
     *
     * @param \Vespolina\Entity\TaxanomyInterface $taxanomy
     *
     * @param boolean $andFlush
     */
    function deleteTaxanomy(TaxanomyInterface $taxanomy, $andFlush = false);

    /**
     * Find a Taxanomy by the value in a field or combination of fields
     *
     * @param \Gateway\QueryInterface $query
     *
     * @return an instance of Vespolina\Entity\TaxanomyInterface or an array of instances of Vespolina\Entity\TaxanomyInterface
     */
    function findTaxanomy(SelectQueryInterface $query = null);

    /**
     * Flush any changes to the database
     */
    function flush();

    /**
     * Persist a Taxanomy that has been created and optionally flush that link.
     * Systems that allow for a delayed flush can use the $andFlush parameter, other
     * systems would disregard the flag. The success of the process is returned.
     *
     * @param Vespolina\Entity\TaxanomyInterface $taxanomy
     *
     * @param boolean $andFlush
     */
    function persistTaxanomy(TaxanomyInterface $taxanomy, $andFlush = false);

    /**
     * Update a Taxanomy that has been persisted and optionally flush that link.
     * Systems that allow for a delayed flush can use the $andFlush parameter, other
     * systems would disregard the flag. The success of the process is returned.
     *
     * @param Vespolina\Entity\TaxanomyInterface $taxanomy
     *
     * @param boolean $andFlush
     */
    function updateTaxanomy(TaxanomyInterface $taxanomy, $andFlush = false);
}
