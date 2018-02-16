<?php

namespace IWD\JOBINTERVIEW\Factory;

use IWD\JOBINTERVIEW\Factory\Answer\QuestionFactory;
use IWD\JOBINTERVIEW\Survey\Answer;

/**
 * Class AnswerFactory.
 *
 * @package IWD\JOBINTERVIEW\Factory
 */
class AnswerFactory
{
    /**
     * The question factory instance.
     *
     * @var QuestionFactory
     */
    protected $questionFactory;

    /**
     * AnswerFactory constructor.
     *
     * @param QuestionFactory $questionFactory
     */
    public function __construct(QuestionFactory $questionFactory)
    {
        $this->questionFactory = $questionFactory;
    }

    /**
     * Makes an answer.
     *
     * @param array $data
     * @return Answer
     */
    public function make(array $data) : Answer
    {
        // Builds the answer's questions
        $data['questions'] = array_map(function($question) {
            try {
                return $this->questionFactory->make($question);
            } catch (\Exception $e) {
                return null;
            }
        }, $data['questions'] ?? []);

        $data['questions'] = array_filter($data['questions']);

        return new Answer($data);
    }

    /**
     * Makes a list of answers.
     *
     * @param array $dataList
     * @return Answer[]
     */
    public function makeAll(array $dataList) : array
    {
        return array_map(array($this, 'make'), $dataList);
    }
}
