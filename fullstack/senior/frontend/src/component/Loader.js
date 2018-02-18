import React, { Component } from 'react';
import PropTypes from 'prop-types';

/**
 * Displays the pre-loader
 */
class Loader extends Component {

    static propTypes = {
        text: PropTypes.string,
    };

    render() {
        return (
            <div className="Loader">
                {this.props.text || 'Loading...'}
            </div>
        );
    }
}

export default Loader;
