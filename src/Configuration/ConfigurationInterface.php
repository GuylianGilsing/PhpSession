<?php
namespace GuylianGilsing\PhpSession\Configuration;

use GuylianGilsing\PhpSession\Configuration\Rules\RuleInterface;

use GuylianGilsing\PhpSession\AbstractSession;

interface ConfigurationInterface
{
    /**
     * Adds a rule to the session configuration.
     * 
     * @return void.
     */
    public function addRule(RuleInterface $rule) : void;

    /**
     * Enforces all added rules on a given session.
     * 
     * @param \GuylianGilsing\PhpSession\AbstractSession $session The session that you want to enforce the rules upon.
     */
    public function enforceRules(AbstractSession $session) : void;

    /**
     * Runs all the rules to check if the given session complies with all of them.
     * 
     * @return bool
     */
    public function compliesWithRules(AbstractSession $session) : bool;
}
