import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { Label as QuestionLabel } from '../QuestionList';

/**
 * Displays a question of type Numeric
 */
class Numeric extends Component {

    static propTypes = {
        label: PropTypes.string.isRequired,
        value: PropTypes.number.isRequired,
        total: PropTypes.number.isRequired,
    };

    render() {
        return (
            <div className="number">
                <QuestionLabel>{this.props.label}</QuestionLabel>
                <div>
                    Total = {this.props.value}
                </div>
                <div>
                    Average = {this.props.value / this.context.answerCount}
                </div>
            </div>
        );
    }
}

Numeric.contextTypes = {
    answerCount: PropTypes.numeric,
};

export default Numeric;
