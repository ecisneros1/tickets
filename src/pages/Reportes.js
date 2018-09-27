import React, { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import AppNavbar from '../components/AppNavbar';
import LoginModal from '../components/LoginModal';
//import ReporteList from '../components/ReporteList';
import TablaReportes from '../components/TablaReportes';
import ConfirmationModal from '../components/ConfirmationModal';
import {connect} from 'react-redux';

class Reportes extends Component {

  state={
    pushing:this.props.history
  }

  render() {
    return (
      <div className="App">
        <ConfirmationModal modal={this.props.modalC} message={this.props.messageC}></ConfirmationModal>
        <LoginModal></LoginModal>
        <AppNavbar pushing={this.state.pushing}></AppNavbar>
        <TablaReportes></TablaReportes>
      </div>
    );
  }
}

const mapStateToProps=state=>({
  modalC:state.confirmacion.modalC,
  messageC:state.confirmacion.messageC
});

export default connect(mapStateToProps)(Reportes);
