<?php

namespace IWD\JOBINTERVIEW\Contract;

/**
 * Interface QuestionContract.
 *
 * @package IWD\JOBINTERVIEW\Contract
 */
interface QuestionContract
{
    /**
     * Returns the type of the question.
     *
     * @return string
     */
    public static function type() : string;

    /**
     * Returns the label of the question.
     *
     * @return string
     */
    public function label() : string;
}
