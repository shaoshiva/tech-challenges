import React, { Component } from 'react';
import PropTypes from 'prop-types';
import ReactHighcharts from 'react-highcharts';
import { Label as QuestionLabel } from '../QuestionList';

/**
 * Displays a question of type QCM
 */
class Qcm extends Component {

    static propTypes = {
        label: PropTypes.string.isRequired,
        options: PropTypes.array.isRequired,
        values: PropTypes.array.isRequired,
    };


    render() {
        return (
            <div className="Qcm">
                <QuestionLabel>{this.props.label}</QuestionLabel>
                {this.props.options.map((option, index) =>
                    <div className="value">
                        {option} : {this.props.values[index] ? 'Yes' : 'No'}
                    </div>
                )}
            </div>
        );
    }
}

export default Qcm;
