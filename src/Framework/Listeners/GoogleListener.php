<?php

namespace Gifty\Framework\Listeners;

use Gifty\Framework\Events\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GoogleListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return ['response' => 'onResponse'];
    }

    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $headers = $response->headers;

        if ($response->isRedirection()
            || ($headers->has('Content-Type') && strpos($headers->get('Content-Type'), 'html') === false)
            || $event->getRequest()->getRequestFormat() !== 'html'
        ) {
            return;
        }

        $response->setContent($response->getContent().'GA CODE');
    }
}
