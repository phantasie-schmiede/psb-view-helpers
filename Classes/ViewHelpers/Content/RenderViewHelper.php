<?php
declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace PSB\PsbViewHelpers\ViewHelpers\Content;

use Closure;
use RuntimeException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Fluid\ViewHelpers\CObjectViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use function is_array;
use function is_int;
use function is_string;

/**
 * Class RenderViewHelper
 *
 * This ViewHelper renders records from tt_content. There are multiple ways of providing the UIDs.
 * Example 1:
 * <psb:content.render contentElements="{variable}" />
 *
 * Example 2:
 * <psb:content.render>{variable}</psb:content.render>
 *
 * Example 3:
 * {variable -> psb:content.render()}
 *
 * {variable} may be one of the following types:
 * - integer
 * - csv
 * - array
 * - instance of an AbstractEntity (domain model object)
 * - ObjectStorage (containing AbstractEntity instances)
 * - QueryResult (containing AbstractEntity instances)
 *
 * @package PSB\PsbViewHelpers\ViewHelpers\Content
 */
class RenderViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeChildren = false;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * @param array                     $arguments
     * @param Closure                   $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return mixed returns the rendered HTML (unescaped, no format-ViewHelper needed)
     */
    public static function renderStatic(
        array $arguments,
        Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $contentElements = $arguments['contentElements'] ?? $renderChildrenClosure();
        $uidList = [];

        switch (true) {
            case $contentElements instanceof AbstractEntity:
                $uidList[] = $contentElements->getUid();
                break;
            case $contentElements instanceof ObjectStorage:
                foreach ($contentElements as $contentElement) {
                    if (!$contentElement instanceof AbstractEntity) {
                        throw new RuntimeException(__CLASS__ . ': ObjectStorage has to contain only domain models that extend AbstractEntity!',
                            1651223157);
                    }

                    $uidList[] = $contentElement->getUid();
                }

                break;
            case $contentElements instanceof QueryResultInterface:
                foreach ($contentElements as $contentElement) {
                    if (!$contentElement instanceof AbstractEntity) {
                        throw new RuntimeException(__CLASS__ . ': QueryResult has to contain only domain models that extend AbstractEntity!',
                            1651223524);
                    }

                    $uidList[] = $contentElement->getUid();
                }

                break;
            case is_array($contentElements):
                foreach ($contentElements as $contentElement) {
                    if ($contentElement instanceof AbstractEntity) {
                        $uidList[] = $contentElement->getUid();
                    } elseif (true === is_int($contentElement)) {
                        $uidList[] = $contentElement;
                    } else {
                        throw new RuntimeException(__CLASS__ . ': Array has to contain only domain models that extend AbstractEntity or integer values!',
                            1651223524);
                    }
                }

                break;
            case is_int($contentElements):
                $uidList[] = $contentElements;
                break;
            case is_string($contentElements):
                $uidList = GeneralUtility::intExplode(',', $contentElements, true);
        }

        $arguments['typoscriptObjectPath'] = 'lib.tx_psbviewhelpers.content';
        $renderChildrenClosure = static function () use ($uidList) {
            return implode(',', $uidList);
        };

        return CObjectViewHelper::renderStatic($arguments, $renderChildrenClosure, $renderingContext);
    }

    /**
     * @return void
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('contentElements', 'mixed',
            'A list of content elements. May be AbstractEntity, ObjectStorage, QueryResult, array, integer or comma separated list.');
    }
}
