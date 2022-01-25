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

namespace PSB\PsbViewHelpers\ViewHelpers\Variable;

use JsonException;
use PSB\PsbFoundation\Utility\StringUtility;
use TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;

/**
 * Class ConvertStringViewHelper
 *
 * @package PSB\PsbViewHelpers\ViewHelpers
 */
class ConvertStringViewHelper extends AbstractViewHelper
{
    /**
     * @throws Exception
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('string', 'string', 'string to be converted');
    }

    /**
     * @return mixed
     * @throws InvalidConfigurationTypeException
     * @throws JsonException
     */
    public function render()
    {
        return StringUtility::convertString($this->arguments['string']);
    }
}
