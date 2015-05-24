<?php

namespace spec\Pixci;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApplicationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Pixci\Application');
        $this->shouldHaveType('Silly\Application');
    }
}
