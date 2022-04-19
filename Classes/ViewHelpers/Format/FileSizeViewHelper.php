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

namespace PSB\PsbViewHelpers\ViewHelpers\Format;

use Closure;
use PSB\PsbFoundation\Utility\FileUtility;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class FileSizeViewHelper
 *
 * @package PSB\PsbViewHelpers\ViewHelpers\Format
 */
class FileSizeViewHelper extends AbstractViewHelper
{
    /**
     * If argument size is not provided, the tag content will be used instead.
     *
     * @param array                     $arguments
     * @param Closure                   $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return string
     * @throws AspectNotFoundException
     */
    public static function renderStatic(
        array $arguments,
        Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {
        $size = $arguments['size'] ?? $renderChildrenClosure();

        return FileUtility::formatFileSize($size, $arguments['unit'], $arguments['decimals']);
    }

    /**
     * @return void
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('decimals', 'integer', 'number of decimals that will be shown in the formatted string',
            false, 2);
        $this->registerArgument('size', 'integer', 'file size in bytes');
        $this->registerArgument('unit', 'string', 'enforces a specific unit', false);
    }
}
