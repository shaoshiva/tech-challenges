<?php

namespace IWD\JOBINTERVIEW\Repository\Survey;

use IWD\JOBINTERVIEW\Contract\Question\NumericContract;
use IWD\JOBINTERVIEW\Contract\Question\QcmContract;
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
     * Returns the answers of a survey by its code.
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
     * Returns the answers count of a survey by its code.
     *
     * @param string $code
     * @return int
     */
    public function countBySurveyCode(string $code) : int
    {
        return count($this->findBySurveyCode($code));
    }

    /**
     * Returns the aggregation of answers to a survey by its code.
     *
     * @param string $code
     * @return array
     */
    public function findAggregationBySurveyCode(string $code) : array
    {
        $answers = $this->findBySurveyCode($code);

        // Gets questions values
        $aggregations = array_reduce($answers, function(array $carry, Answer $answer) {
            foreach ($answer->questions() as $index => $question) {
                // Numeric
                if ($question instanceof NumericContract) {
                    if (!isset($carry[$index])) {
                        $carry[$index] = [
                            'type' => $question::type(),
                            'label' => $question->label(),
                            'value' => $question->value(),
                        ];
                    }
                    $carry[$index]['value'] += $question->value();
                }
                // QCM
                elseif ($question instanceof QcmContract) {
                    if (!isset($carry[$index])) {
                        $carry[$index] = [
                            'type' => $question::type(),
                            'label' => $question->label(),
                            'options' => $question->options(),
                            'values' => $question->values(),
                        ];
                    }
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
