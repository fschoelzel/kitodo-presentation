<?php

/**
 * (c) Kitodo. Key to digital objects e.V. <contact@kitodo.org>
 *
 * This file is part of the Kitodo and TYPO3 projects.
 *
 * @license GNU General Public License version 3 or later.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Kitodo\Dlf\Format;

use Kitodo\Dlf\Common\MetadataInterface;

/**
 * Metadata LibRML format class for the 'dlf' extension
 *
 * @package TYPO3
 * @subpackage dlf
 *
 * @access public
 */
class LibRML implements MetadataInterface
{
    /**
     * This extracts the essential LibRML metadata from XML
     *
     * @access public
     *
     * @param \SimpleXMLElement $xml The XML to extract the metadata from
     * @param mixed[] &$metadata The metadata array to fill
     * @param bool $useExternalApis true if external APIs should be called, false otherwise
     *
     * @return void
     */
    public function extractMetadata(\SimpleXMLElement $xml, array &$metadata, bool $useExternalApis): void
    {
        // register LibRML namespace depending on document
        $this->registerLibrmlNamespace($xml);

        // download
        $actionDownload = $xml->xpath('./librml:item/librml:action[@type="download"]');
        if (!empty($actionDownload) && !empty($actionDownload[0])) {
            $metadata['librml_permission_download'] = [(string) $actionDownload[0]['permission']];
        }

        // index
        $actionIndex = $xml->xpath('./librml:item/librml:action[@type="index"]');
        if (!empty($actionIndex) && !empty($actionIndex[0])) {
            $metadata['librml_permission_index'] = [(string) $actionIndex[0]['permission']];
        }

        // displaymetadata
        $actionDisplaymetadata = $xml->xpath('./librml:item/librml:action[@type="displaymetadata"]');
        if (!empty($actionDisplaymetadata) && !empty($actionDisplaymetadata[0])) {
            $metadata['librml_permission_displaymetadata'] = [(string) $actionDisplaymetadata[0]['permission']];
        }

        // dump the $metadata array
        // debug($metadata);
    }

    /**
     * This registers the necessary LibRML namespace for the current XML
     *
     * @access private
     *
     * @param \SimpleXMLElement &$xml: The XML to register the namespace for
     *
     * @return void
     */
    private function registerLibRmlNamespace(\SimpleXMLElement $xml): void
    {
        $namespace = $xml->getDocNamespaces();

        if (is_array($namespace) && in_array('http://librml.org/schema', $namespace, true)) {
            $xml->registerXPathNamespace('librml', 'http://librml.org/schema');
        }
    }
}
