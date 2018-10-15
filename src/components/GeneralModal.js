import React, {Component} from 'react';
import {connect} from 'react-redux';
import proxy from '../config/proxy/proxy';
import { Button, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Label, Input} from 'reactstrap';



class GeneralModal extends Component {

  constructor(){
    super();
    this.state={
      data:{
        name:'empty',
        fechainicio:new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate(),
        fechafinal:new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate(),
        cliente:'empty'
      }
    }
    this.communication=this.communication.bind(this);
  }

    closeModal(){
        this.props.toggle();
    }


    handle=(event)=>{
      switch(event.target.name){
          case 'date':{
              this.setState({
                  fechainicio:event.target.value
              });
              break;
          }
          case 'date1':{
              this.setState({
                  fechafinal:event.target.value
              });
              break;
          }
          case 'text':{
            this.setState({
              cliente:event.target.value
            });
            break;
          }
          default:{
            break;
          }
      }
  }

  communication(){
    // Create a form
    var mapForm = document.createElement("form");
    mapForm.target = "_blank";    
    mapForm.method = "POST";
    mapForm.action = proxy+"index.php";

    //console.log(this.state.data);

    // Create an input
    var mapInput = document.createElement("input");
    mapInput.type = "hidden";
    mapInput.name = this.state.data.name;
    mapInput.value = "1";
    var mapInput1 = document.createElement("input");
    mapInput1.type = "hidden";
    mapInput1.name = "fechainicio";
    mapInput1.value = this.state.data.fechainicio;
    var mapInput2 = document.createElement("input");
    mapInput2.type = "hidden";
    mapInput2.name = "fechafinal";
    mapInput2.value = this.state.data.fechafinal;
    var mapInput3 = document.createElement("input");
    mapInput3.type = "hidden";
    mapInput3.name = "cliente";
    mapInput3.value = this.state.data.cliente; 
    var mapInput4 = document.createElement("input");
    mapInput4.type = "hidden";
    mapInput4.name = "token";
    mapInput4.value = this.props.token;
    var mapInput5 = document.createElement("input");
    mapInput5.type = "hidden";
    mapInput5.name = "general";
    mapInput5.value = "1";

    // Add the input to the form
    mapForm.appendChild(mapInput);
    mapForm.appendChild(mapInput1);
    mapForm.appendChild(mapInput2);
    mapForm.appendChild(mapInput3);
    mapForm.appendChild(mapInput4);
    mapForm.appendChild(mapInput5);

    // Add the form to dom
    document.body.appendChild(mapForm);

    // Just submit
    mapForm.submit();
  }

  general(){
    
    this.state.data={
        name:'pdf',
        fechainicio:this.state.fechainicio,
        fechafinal:this.state.fechafinal,
        cliente:this.state.cliente
      }
   
    this.communication();
  }

  cliente(){
    
     this.state.data={
        name:'pdfCliente',
        fechainicio:this.state.fechainicio,
        fechafinal:this.state.fechafinal,
        cliente:this.state.cliente
      }
    
    this.communication();
  }

  clientes(){
    
      this.state.data={
        name:'pdfClientes',
        fechainicio:this.state.fechainicio,
        fechafinal:this.state.fechafinal,
        cliente:this.state.cliente
      }
    
    this.communication();
  }

  render() {
    return (
      <div>
        <Modal isOpen={this.props.modal}>
          <ModalHeader>Login</ModalHeader>
          <ModalBody>
            <FormGroup>
            <Label>Fecha Inicio</Label>
            <Input type="text" name="date" placeholder="Ingresar en este formato: YYYY-MM-dd" onChange={this.handle.bind(this)} />
            </FormGroup>
            <FormGroup>
            <Label>Fecha Final</Label>
            <Input type="text" name="date1" placeholder="Ingresar en este formato: YYYY-MM-dd" onChange={this.handle.bind(this)} />
            </FormGroup>
            <FormGroup>
            <Label>Nombre de Cliente</Label>
            <Input type="text" name="text" placeholder="Solo para horas por cliente" onChange={this.handle.bind(this)} />
            </FormGroup>
            <Button size="lg" block onClick={()=>this.general()} >Horas General</Button>
            <Button size="lg" block onClick={()=>this.clientes()} >Horas por Clientes</Button>
            <Button size="lg" block onClick={()=>this.cliente()} >Horas por Cliente</Button>
          </ModalBody>
          <ModalFooter>
            <Button color="danger" onClick={()=>this.closeModal()}>Cancelar</Button>
          </ModalFooter>
        </Modal>
      </div>
    );
  }
}


const mapStateToProps=state=>({
  token:state.login.token
});

export default connect(mapStateToProps)(GeneralModal);