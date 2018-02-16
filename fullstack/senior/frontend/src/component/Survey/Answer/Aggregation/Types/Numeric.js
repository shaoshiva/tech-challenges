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
    };

    render() {
        return (
            <div className="number">
                <QuestionLabel>{this.props.label}</QuestionLabel>
                {this.props.value}
            </div>
        );
    }
}

export default Numeric;
