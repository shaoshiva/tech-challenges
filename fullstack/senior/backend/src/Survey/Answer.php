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
        return $this->get('survey.name');
    }

    /**
     * Returns the survey code.
     *
     * @return string|null
     */
    public function surveyCode() : string
    {
        return $this->get('survey.code');
    }

    /**
     * Returns the questions.
     *
     * @return QuestionContract[]
     */
    public function questions() : array
    {
        return $this->get('questions', []);
    }

    /**
     * Returns a data value by path.
     *
     * @param string|null $path
     * @param mixed|null $default
     * @return mixed
     */
    protected function get(string $path = null, $default = null)
    {
        return array_get($this->data, $path, $default);
    }
}
