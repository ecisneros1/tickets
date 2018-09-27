import React, {Component} from 'react';
import { Button, Form, FormGroup, Label, Input } from 'reactstrap';
import {connect} from 'react-redux';
import {loginUser} from '../appdata/actions/loginActions';

class LoginForm extends Component {

  state={
      username:'empty',
      password:'empty'
  }

    handle=(event)=>{
        switch(event.target.name){
            case 'username':{
                this.setState({
                    username:event.target.value
                });
                break;
            }

            case 'password':{
                this.setState({
                    password:event.target.value
                });
                break;
            }

            default:{
              break;
            }
        }
    }


    onClickAceptar=(e)=>{
      e.preventDefault();

      const username=this.state.username;
      const password=this.state.password;
      this.props.loginUser(username, password);
    }

  render() {
    return (
      <Form>
        <FormGroup>
          <Label>Usuario</Label>
          <Input type="text" name="username" onChange={this.handle.bind(this)}/>
        </FormGroup>
        <FormGroup>
          <Label>Contraseña</Label>
          <Input type="text" name="password" onChange={this.handle.bind(this)}/>
        </FormGroup>
        <Button onClick={this.onClickAceptar} color='success'>Ingresar</Button>
      </Form>
    );
  }
}

const mapStateToProps=state=>({
  token:state.token,
});

export default connect(mapStateToProps, {loginUser})(LoginForm);