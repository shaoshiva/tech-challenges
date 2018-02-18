<?php

namespace IWD\JOBINTERVIEW\Repository\Survey;

use IWD\JOBINTERVIEW\Contract\Question\NumericContract;
use IWD\JOBINTERVIEW\Contract\Question\QcmContract;
use IWD\JOBINTERVIEW\Contract\QuestionContract;
use IWD\JOBINTERVIEW\Factory\AnswerFactory;
use IWD\JOBINTERVIEW\Survey\Answer;

/**
 * Class AnswerRepository.
 *
 * @package IWD\JOBINTERVIEW\Repository\Survey
 */
class AnswerRepository
{
    /**
     * The answer factory instance.
     *
     * @var AnswerFactory
     */
    protected $answerFactory;

    /**
     * The data files path.
     *
     * @var
     */
    protected $dataPath;

    /**
     * AnswerRepository constructor.
     *
     * @param AnswerFactory $answerFactory
     */
    public function __construct(AnswerFactory $answerFactory)
    {
        $this->answerFactory = $answerFactory;
    }

    /**
     * Sets the data path.
     *
     * @param string $path
     * @return $this
     */
    public function setDataPath(string $path)
    {
        $this->dataPath = $path;

        return $this;
    }

    /**
     * Finds all answers.
     *
     * @return Answer[]
     */
    public function findAll() : array
    {
        return $this->fetchDataList();
    }

    /**
     * Retunrs the answers count.
     *
     * @return Answer[]
     */
    public function countAll() : array
    {
        return count($this->findAll());
    }

    /**
     * Counts the answers of a survey by its code.
     *
     * @param string $code
     * @return int
     */
    public function countBySurveyCode(string $code) : int
    {
        return count($this->findBySurveyCode($code));
    }

    /**
     * Finds the answers of a survey by its code.
     *
     * @param string $code
     * @return array
     */
    public function findBySurveyCode(string $code) : array
    {
        $answers = $this->fetchDataList();

        // Filters by survey code
        $answers = array_filter($answers, function(Answer $answer) use ($code) {
            return $answer->surveyCode() === $code;
        });

        $answers = array_values($answers);

        return $answers;
    }

    /**
     * Returns the answers of a survey by its code.
     *
     * @param string $code
     * @return array
     */
    public function getBySurveyCode(string $code) : array
    {
        $answers = $this->findBySurveyCode($code);

        // Converts answers to array
        $answers = array_map(array($this, 'getAnswerAsArray'), $answers);

        return $answers;
    }

    /**
     * Returns the aggregation of answers to a survey by its code.
     *
     * @param string $code
     * @return array
     */
    public function getAggregationBySurveyCode(string $code) : array
    {
        $answers = $this->findBySurveyCode($code);

        // Gets the aggregated values of the questions
        $aggregations = array_reduce($answers, function(array $carry, Answer $answer) {
            foreach ($answer->questions() as $index => $question) {

                // Initializes the question array
                if (!isset($carry[$index])) {
                    $carry[$index] = $this->getQuestionAsArray($question);
                }

                // Numeric (sum the values)
                if ($question instanceof NumericContract) {
                    $carry[$index]['value'] += $question->value();
                }
                // QCM (count the values)
                elseif ($question instanceof QcmContract) {
                    foreach ($question->values() as $valueIndex => $value) {
                        $carry[$index]['values'][$valueIndex] += (int) $value;
                    }
                }
            }

            return $carry;
        }, []);

        return $aggregations;
    }

    /**
     * Returns the answer as an array.
     *
     * @param Answer $answer
     * @return array
     */
    protected function getAnswerAsArray(Answer $answer)
    {
        return [
            'survey' => [
                'name' => $answer->surveyName(),
                'code' => $answer->surveyCode(),
            ],
            'questions' => array_map(array($this, 'getQuestionAsArray'), $answer->questions())
        ];
    }

    /**
     * Returns the question as an array.
     *
     * @param QuestionContract $question
     * @return array|null
     */
    protected function getQuestionAsArray(QuestionContract $question)
    {
        // Numeric
        if ($question instanceof NumericContract) {
            return [
                'type' => $question::type(),
                'label' => $question->label(),
                'value' => $question->value(),
            ];
        }
        // QCM
        elseif ($question instanceof QcmContract) {
            return [
                'type' => $question::type(),
                'label' => $question->label(),
                'options' => $question->options(),
                'values' => $question->values(),
            ];
        } else {
            return null;
        }
    }

    /**
     * Fetchs all the answers.
     *
     * @return Answer[]
     */
    protected function fetchDataList() : array
    {
        $dataList = array_map(function($file) {
            return json_decode(file_get_contents($file), true);
        }, $this->fetchDataFiles());

        return $this->answerFactory->makeAll($dataList);
    }

    /**
     * Lists the answers files
     *
     * @return array
     */
    protected function fetchDataFiles() : array
    {
        $files = [];
        foreach (new \DirectoryIterator($this->dataPath) as $fileInfo) {
            if (!$fileInfo->isDot() && $fileInfo->getExtension() === 'json') {
                $files[] = $fileInfo->getRealPath();
            }
        }

        return $files;
    }
}
