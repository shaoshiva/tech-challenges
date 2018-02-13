<?php

namespace IWD\JOBINTERVIEW\Factory\Answer;

/**
 * Class QuestionFactory.
 *
 * @package IWD\JOBINTERVIEW\Factory\Answer
 */
class QuestionFactory
{
    /**
     * Available question classes.
     *
     * @var array
     */
    protected $classes;

    /**
     * QuestionFactory constructor.
     * @param array $classes
     */
    public function __construct(array $classes)
    {
        $this->classes = $classes;
    }

    /**
     * Makes a question.
     *
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function make($data)
    {
        // Finds the class by type
        foreach ($this->classes as $class) {
            if ($class::type() === $data->type) {
                return new $class($data);
            }
        }

        throw new \Exception('Missing type or type not found.');
    }
}
