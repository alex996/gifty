<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
    public function indexAction(Request $request, int $year)
    {
        if ($this->isLeapYear($year)) {
            return new Response('This is a leap year');
        }

        return new Response('This is not a leap year');
    }

    protected function isLeapYear($year = null)
    {
        if (null === $year) {
            $year = date('Y');
        }

        return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
    }
}
