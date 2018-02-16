<?php

namespace IWD\JOBINTERVIEW\Controller\Api\Survey;

use IWD\JOBINTERVIEW\Repository\Survey\AnswerRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AnswerController.
 *
 * @package IWD\JOBINTERVIEW\Controller\Api\Survey
 */
class AnswerController
{
    /**
     * The answer repository instance.
     *
     * @var AnswerRepository
     */
    protected $answerRepository;

    /**
     * AnswerController constructor.
     *
     * @param AnswerRepository $repository
     */
    public function __construct(AnswerRepository $repository)
    {
        $this->answerRepository = $repository;
    }

    /**
     * Gets the answers by survey code.
     *
     * @param $code
     * @return JsonResponse
     */
    public function getAnswersByCode($code)
    {
        return new JsonResponse([
            'count' => $this->answerRepository->countBySurveyCode($code),
            'answers' => $this->answerRepository->findBySurveyCode($code),
        ]);
    }

    /**
     * Gets the answers aggregation by survey code.
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
