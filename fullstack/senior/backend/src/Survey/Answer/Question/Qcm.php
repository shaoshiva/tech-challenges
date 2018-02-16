<?php

namespace IWD\JOBINTERVIEW\Survey\Answer\Question;

use IWD\JOBINTERVIEW\Contract\Question\QcmContract;
use IWD\JOBINTERVIEW\Survey\Answer\QuestionAbstract;

/**
 * Class Qcm.
 *
 * @package IWD\JOBINTERVIEW\Survey\Answer\Question
 */
class Qcm extends QuestionAbstract implements QcmContract
{
    public static $type = 'qcm';

    /**
     * Returns the labels of the options.
     *
     * @return array
     */
    public function options() : array
    {
        return $this->get('options', []);
    }

    /**
     * Returns the values of the options.
     *
     * @return array
     */
    public function values() : array
    {
        return $this->get('answer', []);
    }
}
