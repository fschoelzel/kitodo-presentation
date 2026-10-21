<?php

declare(strict_types=1);

namespace Kitodo\Dlf\Event;

use SimpleXMLElement;

final class LibRmlDetectedEvent
{
    public function __construct(
        private readonly string $metadataId,
        private readonly SimpleXMLElement $libRmlXml,
    ) {
    }

    public function getMetadataId(): string
    {
        return $this->metadataId;
    }

    public function getLibRmlXml(): SimpleXMLElement
    {
        return $this->libRmlXml;
    }
}