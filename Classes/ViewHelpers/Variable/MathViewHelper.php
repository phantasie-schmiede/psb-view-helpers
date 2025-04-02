<?php
declare(strict_types=1);

/*
 * This file is part of PSB View Helpers.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace PSB\PsbViewHelpers\ViewHelpers\Variable;

use InvalidArgumentException;
use JsonException;
use PSB\PsbFoundation\Utility\StringUtility;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use function is_string;

/**
 * Class MathViewHelper
 *
 * @package PSB\PsbViewHelpers\ViewHelpers\Variable
 */
class MathViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('a', 'mixed', 'first operand', true);
        $this->registerArgument('b', 'mixed', 'second operand', true);
        $this->registerArgument('operator', 'string', 'Mathematical operation to perform (+, -, *, /, **)', true);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws JsonException
     * @throws NotFoundExceptionInterface
     */
    public function render(): float|int|string
    {
        $a = $this->arguments['a'];
        $b = $this->arguments['b'];

        if (is_string($a)) {
            $a = StringUtility::convertString($a);
        }

        if (is_string($b)) {
            $b = StringUtility::convertString($b);
        }

        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException(__CLASS__ . ': At least one argument is not numeric!', 1558773027);
        }

        return match ($this->arguments['operator']) {
            '+'     => $a + $b,
            '-'     => $a - $b,
            '*'     => $a * $b,
            '/'     => $a / $b,
            '**'    => $a ** $b,
            default => throw new InvalidArgumentException(__CLASS__ . ': Operator not allowed!', 1558773161),
        };
    }
}
