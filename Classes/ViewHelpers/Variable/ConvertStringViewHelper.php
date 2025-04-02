<?php
declare(strict_types=1);

/*
 * This file is part of PSB View Helpers.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace PSB\PsbViewHelpers\ViewHelpers\Variable;

use JsonException;
use PSB\PsbFoundation\Utility\StringUtility;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class ConvertStringViewHelper
 *
 * @package PSB\PsbViewHelpers\ViewHelpers
 */
class ConvertStringViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('string', 'string', 'string to be converted');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws JsonException
     * @throws NotFoundExceptionInterface
     */
    public function render(): mixed
    {
        return StringUtility::convertString($this->arguments['string']);
    }
}
