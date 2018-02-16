import React, { Component } from 'react';
import PropTypes from 'prop-types';

/**
 * Questions list
 */
class Number extends Component {

    static propTypes = {
        label: PropTypes.string.isRequired,
        value: PropTypes.number.isRequired,
    };

    render() {
        return (
            <div className="number">
                {this.props.label} {this.props.value}
            </div>
        );
    }
}

export default Number;
