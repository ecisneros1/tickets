import React, { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import AppNavbar from '../components/AppNavbar';
import LoginModal from '../components/LoginModal';
//import TicketList from '../components/TicketList';
import TablaPrueba from '../components/TablaTickets';
import ConfirmationModal from '../components/ConfirmationModal';
import {connect} from 'react-redux';

class Home extends Component {

  state={
    pushing:this.props.history
  }

  render() {
    return (
      <div className="App">
      <ConfirmationModal modal={this.props.modalC} message={this.props.messageC}></ConfirmationModal>
        <LoginModal></LoginModal>
        <AppNavbar pushing={this.state.pushing}></AppNavbar>
        <TablaPrueba></TablaPrueba>
      </div>
    );
  }
}

const mapStateToProps=state=>({
  modalC:state.confirmacion.modalC,
  messageC:state.confirmacion.messageC
});

export default connect(mapStateToProps)(Home);
