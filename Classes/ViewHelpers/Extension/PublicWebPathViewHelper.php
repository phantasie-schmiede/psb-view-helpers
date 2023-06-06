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

namespace PSB\PsbViewHelpers\ViewHelpers\Extension;

use PSB\PsbFoundation\Exceptions\ImplementationException;
use PSB\PsbFoundation\Service\ExtensionInformationService;
use PSB\PsbFoundation\Utility\Configuration\FilePathUtility;
use TYPO3\CMS\Core\Resource\Exception\InvalidFileException;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class PublicWebPathViewHelper
 *
 * @package PSB\PsbViewHelpers\ViewHelpers\Extension
 */
class PublicWebPathViewHelper extends AbstractViewHelper
{
    /**
     * @param ExtensionInformationService $extensionInformationService
     */
    public function __construct(
        protected readonly ExtensionInformationService $extensionInformationService,
    ) {
    }

    /**
     * @return void
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('extensionKey', 'string', 'extension key of the extension whose public resource path should be fetched', true);
        $this->registerArgument('subdirectory', 'string', 'optional path which will be added to the public resource path', false, '');
    }

    /**
     * @return string
     * @throws ImplementationException
     * @throws InvalidFileException
     */
    public function render(): string
    {
        $extensionInformation = $this->extensionInformationService->getExtensionInformation($this->arguments['extensionKey']);

        return FilePathUtility::getPublicResourceWebPath($extensionInformation, $this->arguments['subdirectory']);
    }
}
