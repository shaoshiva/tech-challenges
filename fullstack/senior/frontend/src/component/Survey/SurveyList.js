import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import './SurveyList.css';

class Item extends Component {

    static propTypes = {
        label: PropTypes.string.isRequired,
        code: PropTypes.string.isRequired,
    };

    render() {
        return (
            <li className="Survey-list-item">
                {this.props.label}
                <div className="actions">
                    <Link to={'/aggregation/survey/'+this.props.code} className="btn btn-primary btn-sm">
                        Show answers aggregation
                    </Link>
                </div>
            </li>
        );
    }
}

class List extends Component {
    render() {
        return (
            <div className="Survey-list">
                <h1>
                    Survey list
                </h1>
                <ul>
                    <Item code="XX2" label="Survey XX2" />
                </ul>
            </div>
        );
    }
}

export default List;
