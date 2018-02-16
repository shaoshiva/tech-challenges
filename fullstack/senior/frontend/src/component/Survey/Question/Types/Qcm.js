import React, { Component } from 'react';
import PropTypes from 'prop-types';

/**
 * Questions list
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
                {this.props.label}
                <ul>
                    {this.props.options.map((option, index) => (
                        <li class="Qcm-option">
                            {option} : {this.props.values[index]}
                        </li>
                    ))}
                </ul>
            </div>
        );
    }
}

export default Qcm;
