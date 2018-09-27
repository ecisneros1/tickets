import React, {Component} from 'react';
import { Button, Modal, ModalHeader, ModalBody, ModalFooter} from 'reactstrap';
import {closeConfirmacion} from '../appdata/actions/confirmacionActions';
import {connect} from 'react-redux';



class ConfirmationModal extends Component {

    closeConfirm(){
        this.props.closeConfirmacion();
    }

  render() {
    return (
      <div>
        <Modal isOpen={this.props.modal}>
          <ModalHeader>MENSAJE DEL SISTEMA</ModalHeader>
          <ModalBody>
            {this.props.message}
          </ModalBody>
          <ModalFooter>
            <Button color="success" onClick={()=>this.closeConfirm()}>Aceptar</Button>
          </ModalFooter>
        </Modal>
      </div>
    );
  }
}

const mapStateToProps=state=>({
});

export default connect(mapStateToProps,{closeConfirmacion})(ConfirmationModal);