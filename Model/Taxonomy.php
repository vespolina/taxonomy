<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\TaxonomyBundle\Model;

use Vespolina\TaxonomyBundle\Model\TaxonomyInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
 abstract class Taxonomy implements TaxonomyInterface
{
    protected $numberOfTerms;
    protected $name;
    protected $type;


    public function __construct()
    {

    }


    /**
     * @inheritdoc
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getNumberOfTerms()
    {

        return $this->numberOfTerms;
    }

    /**
      * @inheritdoc
      */
    public function getType()
    {

        return $this->type;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {

        $this->name = $name;
    }

    public function setNumberOfTerms($numberOfTerms)
    {

        $this->numberOfTerms;
    }

    public function setType($type)
    {

        $this->type = $type;
    }

}