<?php

namespace App\Controllers;

use App\Models\LeapYear;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
    public function indexAction(Request $request, $year)
    {
        $leapYear = new LeapYear; // TODO: move to d.i.

        if ($leapYear->isLeapYear($year)) {
            return new Response('This is a leap year');
        }

        return new Response('This is not a leap year');
    }
}
