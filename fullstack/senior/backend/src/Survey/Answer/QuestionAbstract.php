<?php

namespace IWD\JOBINTERVIEW\Survey\Answer;

use IWD\JOBINTERVIEW\Contract\QuestionContract;

/**
 * Class QuestionAbstract.
 *
 * @package IWD\JOBINTERVIEW\Survey\Answer
 */
abstract class QuestionAbstract implements QuestionContract
{
    protected static $type;
    protected $data;

    /**
     * QuestionAbstract constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Returns the type of the question.
     *
     * @return string
     */
    public static function type() : string
    {
        return static::$type;
    }

    /**
     * Returns the label of the question.
     *
     * @return string
     */
    public function label() : string
    {
        return $this->data->label;
    }
}
