<?php

namespace IWD\JOBINTERVIEW\Contract\Question;

use IWD\JOBINTERVIEW\Contract\QuestionContract;

/**
 * Interface NumericContract.
 *
 * @package IWD\JOBINTERVIEW\Contract\Question
 */
interface NumericContract extends QuestionContract
{
    /**
     * Returns the numeric value of the answer.
     *
     * @return int
     */
    public function value() : int;
}
