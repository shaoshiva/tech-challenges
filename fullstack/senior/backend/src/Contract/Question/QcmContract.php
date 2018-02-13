<?php

namespace IWD\JOBINTERVIEW\Contract\Question;

use IWD\JOBINTERVIEW\Contract\QuestionContract;

/**
 * Interface QcmContract.
 *
 * @package IWD\JOBINTERVIEW\Contract\Question
 */
interface QcmContract extends QuestionContract
{
    /**
     * Returns the labels of the options.
     *
     * @return array
     */
    public function options() : array;

    /**
     * Returns the values of the options.
     *
     * @return array
     */
    public function values() : array;
}
