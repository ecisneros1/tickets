import React, {Component} from 'react';
import VerReporteForm from './VerReporteForm';
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

export default VerReporteModal;