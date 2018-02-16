import React, { Component } from 'react';
import PropTypes from 'prop-types';
import Qcm from './Types/Qcm';
import Numeric from './Types/Numeric';
import './QuestionList.css';

export class Label extends Component {
    render() {
        return (
            <div className="label">
                {this.props.children}
            </div>
        );
    }
}

/**
 * Questions list
 */
export class Item extends Component {

    static propTypes = {
        question: PropTypes.object.isRequired,
    };

    renderByType() {
        switch (this.props.question.type) {
            case 'qcm':
                return <Qcm
                    label={this.props.question.label}
                    values={this.props.question.values}
                    options={this.props.question.options}
                />;
            case 'numeric':
                return <Numeric
                    label={this.props.question.label}
                    value={this.props.question.value}
                />;
        }
    }

    render() {
        return (
            <div className="QuestionList-item">
                {this.renderByType()}
            </div>
        );
    }
}

/**
 * Questions list
 */
export class List extends Component {

    static propTypes = {
        questions: PropTypes.array.isRequired,
    };

    render() {
        return (
            <div className="QuestionList">
                {this.props.questions.map((question, index) =>
                    <Item key={index} question={question} />
                )}
            </div>
        );
    }
}


export default List;
