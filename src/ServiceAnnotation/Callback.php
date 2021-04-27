<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\ContaoFormhybridCompatibilityBundle\ServiceAnnotation;

use Doctrine\Common\Annotations\Annotation\Attribute;
use Doctrine\Common\Annotations\Annotation\Attributes;
use Doctrine\Common\Annotations\Annotation\Target;
use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTagInterface;

/**
 * Annotation to register a DCA callback.
 *
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 * @Attributes({
 *     @Attribute("table", type="string", required=true),
 *     @Attribute("target", type="string", required=true),
 *     @Attribute("formhybrid", type="bool"),
 *     @Attribute("priority", type="int"),
 * })
 */
class Callback implements ServiceTagInterface
{
    /**
     * @var string
     */
    public $table;

    /**
     * @var string
     */
    public $target;

    /**
     * @var int
     */
    public $priority;

    /**
     * @var bool
     */
    public $formhybrid;

    public function getName(): string
    {
        return 'contao.callback';
    }

    public function getAttributes(): array
    {
        $attributes = [
            'table' => $this->table,
            'target' => $this->target,
        ];

        if ($this->formhybrid) {
            $attributes['formhybrid'] = $this->formhybrid;
        }

        if ($this->priority) {
            $attributes['priority'] = $this->priority;
        }

        return $attributes;
    }
}