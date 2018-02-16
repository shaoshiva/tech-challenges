<?php

namespace IWD\JOBINTERVIEW\Survey\Answer\Question;

use IWD\JOBINTERVIEW\Contract\Question\NumericContract;
use IWD\JOBINTERVIEW\Survey\Answer\QuestionAbstract;

/**
 * Class Numeric.
 *
 * @package IWD\JOBINTERVIEW\Survey\Answer\Question
 */
class Numeric extends QuestionAbstract implements NumericContract
{
    protected static $type = 'numeric';

    /**
     * Returns the numeric value of the answer.
     *
     * @return int
     */
    public function value() : int
    {
        return (int) $this->get('answer');
    }
}
