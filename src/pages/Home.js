import React, { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import AppNavbar from '../components/AppNavbar';
//import ReporteList from '../components/ReporteList';
import TicketList from '../components/TicketList';

class Home extends Component {

  state={
    pushing:this.props.history
  }

  render() {
    return (
      <div className="App">
        <AppNavbar pushing={this.state.pushing}></AppNavbar>
        <TicketList></TicketList>
      </div>
    );
  }
}

export default Home;
