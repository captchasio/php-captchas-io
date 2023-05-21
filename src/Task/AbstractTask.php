<?php

namespace CaptchasIO\Task;

/**
 * Abstract class AbstractTask.
 */
abstract class AbstractTask
{
    /**
     * Method to build task params
     * @return array
     */
    public abstract function getTaskParams();

    /**
     * Method to build other params
     *
     * @return array
     */
    public abstract function otherRequestParams();
}
