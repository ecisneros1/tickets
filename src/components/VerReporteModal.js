import React, {Component} from 'react';
import VerReporteForm from './VerReporteForm';
import {connect} from 'react-redux';
import {setCalificacionEmpty} from '../appdata/actions/calificacionActions';
import { Button, Modal, ModalHeader, ModalBody, ModalFooter} from 'reactstrap';



class VerReporteModal extends Component {

  render() {
    return (
      <div>
        <Modal isOpen={this.props.modal} className={this.props.className}>
          <ModalHeader toggle={this.props.toggle}>Crear un evento</ModalHeader>
          <ModalBody>
            <VerReporteForm toggle={this.props.toggle} activeReport={this.props.activeReport}></VerReporteForm>
          </ModalBody>
          <ModalFooter>
            <Button color="primary" onClick={this.props.toggle}>Aceptar</Button>
          </ModalFooter>
        </Modal>
      </div>
    );
  }
}

const mapStateToProps=state=>({
  calificacion:state.calificacion
});

export default connect(mapStateToProps, {setCalificacionEmpty})(VerReporteModal);