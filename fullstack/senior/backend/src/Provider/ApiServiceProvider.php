<?php

namespace IWD\JOBINTERVIEW\Provider;

use IWD\JOBINTERVIEW\Controller\Api\Survey\AnswerController;
use IWD\JOBINTERVIEW\Factory\Answer\QuestionFactory;
use IWD\JOBINTERVIEW\Factory\AnswerFactory;
use IWD\JOBINTERVIEW\Repository\Survey\AnswerRepository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiServiceProvider.
 *
 * @package IWD\JOBINTERVIEW\Provider
 */
class ApiServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    /**
     * Register.
     *
     * @param Container $app
     */
    public function register(Container $app)
    {
        $app['survey.answer.repository'] = function() use ($app) {
            return (new AnswerRepository($app['survey.answer.factory']))
                ->setDataPath($app['config']['answers_data_path'] ?? '');
        };

        $app['survey.answer.factory'] = function() use ($app) {
            return new AnswerFactory($app['survey.question.factory']);
        };

        $app['survey.question.factory'] = function() use ($app) {
            return new QuestionFactory($app['config']['survey_questions_classes'] ?? []);
        };

        $app['survey.statistics.controller'] = function() use ($app) {
            return new AnswerController($app['survey.answer.repository']);
        };
    }

    /**
     * Boot.
     *
     * @param Application $app
     */
    public function boot(Application $app)
    {
        $app->before(function (Request $request) {
            // Registers JSON data decoder for JSON requests
            if (0 === strpos((string)$request->headers->get('Content-Type'), 'application/json')) {
                if (!is_array($request->getContent())) {
                    $data = json_decode($request->getContent(), true);
                    $request->request->replace(is_array($data) ? $data : array());
                }
            }
        });

        $app->get('/api/survey/{code}/answersAggregation', function($code) use ($app) {
            return $app['survey.statistics.controller']->getAnswersAggregationByCode($code);
        });

        $app->get('/api/survey/{code}/answers', function($code) use ($app) {
            return $app['survey.statistics.controller']->getAnswersByCode($code);
        });
    }
}
