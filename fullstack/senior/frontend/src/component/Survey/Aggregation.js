import React, { Component } from 'react';
import PropTypes from 'prop-types';
import apiSurvey from '../../api/survey';
import Questions from './Question/QuestionList';
import './Aggregation.css';

/**
 * The pre-loader
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
 * Answers counter
 */
class AnswersCount extends Component {
    render() {
        return (
            <div className="Aggregation-answers-count">
                Number of answers: {this.props.count}
            </div>
        );
    }
}

class Aggregation extends Component {

    constructor(props) {
        super(props);
        this.state = {
            loaded: false,
            data: {},
        };
    }

    componentDidMount() {
        // Requests the survey aggregation from the API
        apiSurvey.methods.aggregationByCode({
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
                <AnswersCount count={this.state.data.count}/>
                <Questions questions={this.state.data.questions} />
            </div>
        );
    }
}

export default Aggregation;
