<?php

class DevBootstrap
{
    private $action;

    private $bearsamppPath;
    private $corePath;
    private $classesPath;
    private $langsPath;

    public function __construct()
    {
        $this->bearsamppPath = DevUtils::formatUnixPath(realpath('../../bearsampp'));
        if (!file_exists($this->bearsamppPath . '/core/bootstrap.php')) {
            throw new Exception("bearsampp repository not found in " . $this->bearsamppPath);
        }

        $this->corePath = $this->bearsamppPath . '/core';
        $this->classesPath = $this->corePath . '/classes';
        $this->langsPath = $this->corePath . '/langs';
    }

    public function process()
    {
        if ($this->isActionExists()) {
            $action = DevUtils::cleanArgv(1);
            $actionFile = 'class.dev.' . $action . '.php';
            $actionClass = 'Dev' . ucfirst($action);

            $args = array();
            foreach ($_SERVER['argv'] as $key => $arg) {
                if ($key > 1) {
                    $args[] = $arg;
                }
            }

            $this->action = null;
            if (file_exists($actionFile)) {
                require_once $actionFile;
                $this->action = new $actionClass($this, $args);
            }
        }
    }

	private function isActionExists()
    {
        return isset($_SERVER['argv'])
            && isset($_SERVER['argv'][1])
            && !empty($_SERVER['argv'][1]);
    }

    public function getbearsamppPath()
    {
        return $this->bearsamppPath;
    }

    public function getCorePath()
    {
        return $this->corePath;
    }

    public function getClassesPath()
    {
        return $this->classesPath;
    }

    public function getLangsPath()
    {
        return $this->langsPath;
    }
}
