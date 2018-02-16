import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import Questions from './Question/QuestionList';
import apiSurvey from '../../api/survey';
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
                <h1>Survey &laquo; {this.props.match.params.code} &raquo;</h1>
                <div className="back-to">
                    <Link to="/">&laquo; Back to survey list</Link>
                </div>
                <br/>
                <h2>Answers aggregation</h2>
                <AnswersCount count={this.state.data.count}/>
                <Questions questions={this.state.data.questions} />
            </div>
        );
    }
}

export default Aggregation;
