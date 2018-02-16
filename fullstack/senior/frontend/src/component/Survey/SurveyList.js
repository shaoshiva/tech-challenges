import React, { Component } from 'react';
import './SurveyList.css';
import { Link } from 'react-router-dom';

class ListItem extends Component {
    render() {
        return (
            <li className="List-Item">
                <Link to={'/aggregation/survey/'+this.props.code}>
                    {this.props.label}
                </Link>
            </li>
        );
    }
}

class List extends Component {
    render() {
        return (
            <div className="List">
                <ul>
                    <ListItem code="XX2" label="Survey XX2" />
                </ul>
            </div>
        );
    }
}

export default List;
