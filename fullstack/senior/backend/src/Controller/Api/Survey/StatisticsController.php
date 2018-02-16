<?php

namespace IWD\JOBINTERVIEW\Controller\Api\Survey;

use IWD\JOBINTERVIEW\Repository\Survey\AnswerRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class StatisticsController.
 *
 * @package IWD\JOBINTERVIEW\Controller\Api\Survey
 */
class StatisticsController
{
    /**
     * The answer repository instance.
     *
     * @var AnswerRepository
     */
    protected $answerRepository;

    /**
     * StatisticsController constructor.
     *
     * @param AnswerRepository $repository
     */
    public function __construct(AnswerRepository $repository)
    {
        $this->answerRepository = $repository;
    }

    /**
     * Gets answers aggregation by survey code.
     *
     * @param $code
     * @return JsonResponse
     */
    public function getAnswersAggregationByCode($code)
    {
        return new JsonResponse([
            'count' => $this->answerRepository->countBySurveyCode($code),
            'questions' => $this->answerRepository->findAggregationBySurveyCode($code),
        ]);
    }
}
