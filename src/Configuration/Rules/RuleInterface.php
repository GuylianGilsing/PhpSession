<?php
namespace GuylianGilsing\PhpSession\Configuration\Rules;

use GuylianGilsing\PhpSession\AbstractSession;

interface RuleInterface
{
    /**
     * Registers or "enforces" the rule with a given session.
     * 
     * @return void
     */
    public function enforce(AbstractSession $session) : void;

    /**
     * Checks if the rule complies with the given session.
     * 
     * @return bool
     */
    public function complies(AbstractSession $session) : bool;
}
