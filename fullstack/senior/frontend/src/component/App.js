import React, { Component } from 'react';
import SurveyList from './Survey/SurveyList';
import SurveyAnswerList from './Survey/Answer/AnswerList';
import SurveyAnswerAggregation from './Survey/Answer/Aggregation';
import { BrowserRouter as Router, Route } from 'react-router-dom';
import './App.css';

class App extends Component {
    render() {
        return (
            <Router>
                <div className="App container-fluid">
                    <Route exact path="/" component={SurveyList}/>
                    <Route exact path="/survey/:code/answers" component={SurveyAnswerList}/>
                    <Route exact path="/survey/:code/answers-aggregation" component={SurveyAnswerAggregation}/>
                </div>
            </Router>
        );
    }
}

export default App;
