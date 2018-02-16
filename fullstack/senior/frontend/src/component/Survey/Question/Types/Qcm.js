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

    hightchartsConfig() {
        return {
            chart: {
                type: 'bar'
            },
            title: {
                text: null,
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '14px',
                        fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: null,
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Answer count',
                data: this.hightchartsData(),

            }]
        };
    }

    hightchartsData() {
        return this.props.options.map((option, index) => {
            return [option, this.props.values[index]];
        });
    }

    render() {
        return (
            <div className="Qcm">
                <QuestionLabel>{this.props.label}</QuestionLabel>
                <ReactHighcharts config={this.hightchartsConfig()} />
            </div>
        );
    }
}

export default Qcm;
