<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Taxonomy;

use Vespolina\Entity\Taxonomy\TaxonomyInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class Taxonomy implements TaxonomyInterface
{
    protected $id;

    protected $name;

    protected $path;

    protected $parent;

    protected $level;

    protected $lockTime;

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setParent(TaxonomyInterface $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getLockTime()
    {
        return $this->lockTime;
    }
}
