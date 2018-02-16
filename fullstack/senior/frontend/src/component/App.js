import React, { Component } from 'react';
import SurveyList from './Survey/SurveyList';
import SurveyAggregation from './Survey/Aggregation';
import { BrowserRouter as Router, Route } from 'react-router-dom';
import './App.css';

class App extends Component {
    render() {
        return (
            <Router>
                <div className="App container-fluid">
                    <Route exact path="/" component={SurveyList}/>
                    <Route exact path="/aggregation/survey/:code" component={SurveyAggregation}/>
                </div>
            </Router>
        );
    }
}

export default App;
