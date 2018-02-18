import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import Loader from '../../Loader';
import AnswersCount from './AnswersCount';
import Questions from './List/QuestionList';
import apiSurvey from '../../../api/survey';
import './Aggregation.css';

/**
 * Displays the answers
 */
class Answers extends Component {

    static propTypes = {
        answers: PropTypes.array.isRequired,
    };

    render() {
        return this.props.answers.map((answer, index) =>
            <div className="AnswerList-answers">
                <h2>Answer #{index}</h2>
                <Questions questions={answer.questions} />
            </div>
        );
    }
}

/**
 * Displays the aggregated answers of a survey
 */
class List extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            data: {},
        };
    }

    componentDidMount() {
        // Requests the survey aggregation from the API
        apiSurvey.methods.answersByCode({
            path: {
                code: this.props.match.params.code,
            }
        }, (data, response) => {
            this.setState({
                loaded: true,
                data: data,
            });
        });
    }

    render() {
        // Displays the loader while loading the remote data
        if (!this.state.loaded) {
            return <Loader />;
        }

        return (
            <div className="Aggregation">
                <h1>Answers of survey &laquo; {this.props.match.params.code} &raquo;</h1>
                <div className="back-to">
                    <Link to="/">&laquo; Back to survey list</Link>
                </div>
                <AnswersCount count={this.state.data.count}/>
                <Answers answers={this.state.data.answers} />
            </div>
        );
    }
}

export default List;
