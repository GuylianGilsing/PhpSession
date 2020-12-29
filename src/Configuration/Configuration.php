<?php
namespace GuylianGilsing\PhpSession\Configuration;

use GuylianGilsing\PhpSession\Configuration\Rules\RuleInterface;

use GuylianGilsing\PhpSession\AbstractSession;

class Configuration implements ConfigurationInterface
{
    private array $rules = [];

    public function addRule(RuleInterface $rule): void
    {
        $this->rules[] = $rule;
    }

    public function enforceRules(AbstractSession $session): void
    {
        if(count($this->rules) > 0)
        {
            foreach($this->rules as $rule)
            {
                $rule->enforce($session);
            } 
        }
    }

    public function compliesWithRules(AbstractSession $session): bool
    {
        if(count($this->rules) > 0)
        {
            foreach($this->rules as $rule)
            {
                if(!$rule->complies($session))
                    return false;
            } 
        }

        return true;
    }
}
