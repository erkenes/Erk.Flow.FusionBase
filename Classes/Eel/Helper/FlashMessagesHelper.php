<?php

namespace Erk\Flow\FusionBase\Eel\Helper;

use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\ActionRequest;
use Neos\Flow\Mvc\FlashMessage\FlashMessageService;

class FlashMessagesHelper implements ProtectedContextAwareInterface
{
    /**
     * @Flow\Inject
     * @var FlashMessageService
     */
    protected $flashMessageService;


    /**
     * Get Flash-Messages for the current request
     *
     * @param ActionRequest $request
     * @param string|null $severity
     * @return array
     */
    public function getFlashMessages(ActionRequest $request, ?string $severity = null): array
    {
        $flashMessageContainer = $this->flashMessageService->getFlashMessageContainerForRequest($request);
        $flashMessages = $flashMessageContainer->getMessagesAndFlush($severity);

        return $flashMessages;
    }

    /**
     * All methods are considered safe, i.e. can be executed from within Eel
     *
     * @param string $methodName
     * @return boolean
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
