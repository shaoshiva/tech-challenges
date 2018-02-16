import React, { Component } from 'react';
import SurveyList from './Survey/SurveyList';
import SurveyAggregation from './Survey/Aggregation';
import './App.css';
import {
    BrowserRouter as Router,
    Route
} from 'react-router-dom';

class App extends Component {
    render() {
        return (
            <Router>
                <div className="App">
                    <Route exact path="/" component={SurveyList}/>
                    <Route exact path="/aggregation/survey/:code" component={SurveyAggregation}/>
                </div>
            </Router>
        );
    }
}

export default App;
