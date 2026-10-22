<?php

declare(strict_types=1);

namespace Kitodo\Dlf\Event;

use SimpleXMLElement;

final class LibRmlDetectedEvent
{
    public function __construct(
        private readonly string $mdId,
        private readonly SimpleXMLElement $libRmlXml,
    ) {
    }

    public function getMdId(): string
    {
        return $this->mdId;
    }

    public function getLibRmlXml(): SimpleXMLElement
    {
        return $this->libRmlXml;
    }
}