<?php

namespace IWD\JOBINTERVIEW\Survey;

use IWD\JOBINTERVIEW\Contract\QuestionContract;

/**
 * Class Answer.
 *
 * @package IWD\JOBINTERVIEW\Survey
 */
class Answer
{
    /**
     * The raw data of the answer.
     *
     * @var array
     */
    protected $data;

    /**
     * Answer constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Returns the survey name.
     *
     * @return string|null
     */
    public function surveyName()
    {
        return $this->data->survey->name ?? null;
    }

    /**
     * Returns the survey code.
     *
     * @return string|null
     */
    public function surveyCode() : string
    {
        return $this->data->survey->code ?? null;
    }

    /**
     * Returns the questions.
     *
     * @return QuestionContract[]
     */
    public function questions() : array
    {
        return $this->data->survey->questions ?? [];
    }
}
