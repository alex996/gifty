<?php

namespace Gifty\Framework\Events;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\{Request, Response};

class ResponseEvent extends Event
{
    protected $request;

    protected $response;

    public function __construct(Response $response, Request $request)
    {
        $this->response = $response;
        $this->request = $request;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getRequest()
    {
        return $this->request;
    }
}
