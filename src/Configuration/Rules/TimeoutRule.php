<?php
namespace GuylianGilsing\PhpSession\Configuration\Rules;

use GuylianGilsing\PhpSession\AbstractSession;

class TimeoutRule implements RuleInterface
{
    protected int $secondsUntilTimeout = 0;
    protected string $ruleKey = "timeout";

    /**
     * Creates a new timeout rule.
     * 
     * @param int $secondsUntilTimeout The time it takes to make the session 'timeout'. 
     */
    public function __construct(int $secondsUntilTimeout = 0)
    {
        if($secondsUntilTimeout > 0)
            $this->secondsUntilTimeout = $secondsUntilTimeout;
    }

    public function enforce(AbstractSession $session): void
    {
        $sessionName = $session->getName();
        if(isset($_SESSION[$sessionName]))
        {
            if(!isset($_SESSION[$sessionName]['_rules']))
                $_SESSION[$sessionName]['_rules'] = [];

            $_SESSION[$sessionName]['_rules'][$this->ruleKey] = time() + $this->secondsUntilTimeout;
        }
    }

    public function complies(AbstractSession $session): bool
    {
        $sessionName = $session->getName();

        if(!isset($_SESSION[$sessionName]))
            return false;

        if(!isset($_SESSION[$sessionName]['_rules']) || !isset($_SESSION[$sessionName]['_rules'][$this->ruleKey]))
            return false;

        if(!is_numeric($_SESSION[$sessionName]['_rules'][$this->ruleKey]))
            return false;

        $currentTime = time();
        if($currentTime > $_SESSION[$sessionName]['_rules'][$this->ruleKey])
            return false;

        return true;
    }
}
