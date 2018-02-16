import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import Questions from './Aggregation/QuestionList';
import apiSurvey from '../../../api/survey';
import './Aggregation.css';

/**
 * Displays the pre-loader
 */
class Loader extends Component {
    render() {
        return (
            <div className="Aggregation-loader">
                @loader
            </div>
        );
    }
}

/**
 * Displays the answers counter
 */
class AnswersCount extends Component {

    static propTypes = {
        count: PropTypes.number.isRequired,
    };

    render() {
        return (
            <div className="Aggregation-answers-count">
                Number of answers: {this.props.count}
            </div>
        );
    }
}

/**
 * Displays the answers aggregation of a survey
 */
class Aggregation extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            data: {},
        };
    }

    getChildContext() {
        return {
            answerCount: this.state.data ? this.state.data.count : null,
        };
    }

    componentDidMount() {
        // Requests the survey aggregation from the API
        apiSurvey.methods.answersAggregationByCode({
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
        if (!this.state.loaded) {
            return <Loader />;
        }

        return (
            <div className="Aggregation">
                <h1>Answers aggregation of survey &laquo; {this.props.match.params.code} &raquo;</h1>
                <div className="back-to">
                    <Link to="/">&laquo; Back to survey list</Link>
                </div>
                <AnswersCount count={this.state.data.count}/>
                <Questions questions={this.state.data.questions} />
            </div>
        );
    }
}

Aggregation.childContextTypes = {
    answerCount: PropTypes.number
};

export default Aggregation;
