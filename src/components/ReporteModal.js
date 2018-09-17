import React, {Component} from 'react';
import ReporteForm from './ReporteForm';
import { Button, Modal, ModalHeader, ModalBody, ModalFooter} from 'reactstrap';



class ReporteModal extends Component {

  render() {
    return (
      <div>
        <Modal isOpen={this.props.modal} className={this.props.className}>
          <ModalHeader toggle={this.toggle}>Crear un evento</ModalHeader>
          <ModalBody>
            <ReporteForm toggle={this.props.toggle} activeTicket={this.props.activeTicket}></ReporteForm>
          </ModalBody>
          <ModalFooter>
            <Button color="danger" onClick={this.props.toggle}>Cancelar</Button>
          </ModalFooter>
        </Modal>
      </div>
    );
  }
}

export default ReporteModal;