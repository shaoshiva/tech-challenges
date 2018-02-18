<?php

return [
    /**
     * The data files path for answers.
     */
    'answers_data_path' => ROOT_PATH.'/data',

    /**
     * The available classes for survey questions
     */
    'survey_questions_classes' => [
        \IWD\JOBINTERVIEW\Survey\Answer\Question\Qcm::class,
        \IWD\JOBINTERVIEW\Survey\Answer\Question\Numeric::class,
    ],
];
