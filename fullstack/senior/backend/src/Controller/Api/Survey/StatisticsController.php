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
     * Answer repository instance.
     *
     * @var AnswerRepository
     */
    protected $repository;

    /**
     * StatisticsController constructor.
     *
     * @param AnswerRepository $repository
     */
    public function __construct(AnswerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Gets statistics for answers by survey code.
     *
     * @param $code
     * @return JsonResponse
     */
    public function getAggregationByCode($code)
    {
        return new JsonResponse([
            'count' => $this->repository->countBySurveyCode($code),
            'questions' => $this->repository->findAggregationBySurveyCode($code),
        ]);
    }
}
