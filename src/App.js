import React, { Component } from 'react';
import Home from './pages/Home';
import Reportes from './pages/Reportes';

import {Provider} from 'react-redux';
import store from './store';
import{
  Switch,
  Route,
  BrowserRouter as Router
}from 'react-router-dom'

class App extends Component {

  render() {
    return (
      <Provider store={store}>
        <Router basename={'/tickets'}>
          
          <Switch>
            <Route /*exact path={`${process.env.PUBLIC_URL}/`}*/ exact path='/' component={Home}/>
            <Route /*exact path={`${process.env.PUBLIC_URL}/reports`}*/ exact path='/reports' component={Reportes}/>
            
          </Switch>     
        </Router>
      </Provider>
    );
  }
}

export default App;
