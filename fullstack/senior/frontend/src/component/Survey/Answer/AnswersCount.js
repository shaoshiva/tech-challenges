import React, { Component } from 'react';
import PropTypes from 'prop-types';

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

export default AnswersCount;
