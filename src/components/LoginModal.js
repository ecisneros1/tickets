import React, {Component} from 'react';
import LoginForm from './LoginForm';
import {connect} from 'react-redux';
import { Button, Modal, ModalHeader, ModalBody, ModalFooter} from 'reactstrap';



class LoginModal extends Component {


    closeLogin(){
        window.location = 'http://www.it3.com.ec';
    }

  render() {
    return (
      <div>
        <Modal isOpen={this.props.modalSt}>
          <ModalHeader>Login</ModalHeader>
          <ModalBody>
            <LoginForm></LoginForm>
          </ModalBody>
          <ModalFooter>
            <Button color="danger" onClick={this.closeLogin}>Cancelar</Button>
          </ModalFooter>
        </Modal>
      </div>
    );
  }
}

const mapStateToProps=state=>({
  modalSt:state.login.modalSt,
});

export default connect(mapStateToProps)(LoginModal);