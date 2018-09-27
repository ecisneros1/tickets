import React, {Component} from 'react';
import { Button, Form, FormGroup, Label, Input } from 'reactstrap';
import {getTicket} from '../appdata/actions/ticketActions';
import {connect} from 'react-redux';
import proxy from '../config/proxy/proxy';

class VerReporteForm extends Component {

  componentDidMount(){
    this.props.getTicket(this.props.activeReport.id_ticket, this.props.token);
    this.setState({
      id:this.props.activeReport.id_reporte
    });
    //console.log(this.props.activeReport.id_reporte);
  }


  onClickImprimir(){
    // Create a form
    var mapForm = document.createElement("form");
    mapForm.target = "_blank";    
    mapForm.method = "POST";
    mapForm.action = proxy+"/api/reportes/administrar_reporte.php";

    // Create an input
    var mapInput = document.createElement("input");
    mapInput.type = "hidden";
    mapInput.name = "pdf";
    mapInput.value = "1";
    var mapInput1 = document.createElement("input");
    mapInput1.type = "hidden";
    mapInput1.name = "id_reporte";
    mapInput1.value = this.state.id;
    var mapInput2 = document.createElement("input");
    mapInput2.type = "hidden";
    mapInput2.name = "token";
    mapInput2.value = this.props.token;

    // Add the input to the form
    mapForm.appendChild(mapInput);
    mapForm.appendChild(mapInput1);
    mapForm.appendChild(mapInput2);

    // Add the form to dom
    document.body.appendChild(mapForm);

    // Just submit
    mapForm.submit();
    //window.open();  
  }

  render() {

    return (
      <Form>
            <FormGroup>
                <Label>ID Reporte</Label>
                <Input type="textarea" name="idreporte" value={this.props.activeReport.id_reporte} disabled />
            </FormGroup>
        <FormGroup>
          <Label>Cliente</Label>
          <Input type="text" name="cliente" value={this.props.activeReport.cliente} disabled/>
        </FormGroup>
        <FormGroup>
          <Label>Teléfono</Label>
          <Input type="text" name="telefono" value={this.props.ticket.activeTicket.phone} disabled/>
        </FormGroup>
        <FormGroup>
          <Label>Correo</Label>
          <Input type="text" name="correo" value={this.props.ticket.activeTicket.email} disabled/>
        </FormGroup>
        <FormGroup>
          <Label>ID Ticket</Label>
          <Input type="text" name="ticket" value={this.props.activeReport.id_ticket} disabled/>
        </FormGroup>
        <FormGroup>
          <Label>Contacto</Label>
          <Input type="text" name="contacto" value={this.props.activeReport.contacto} disabled />
        </FormGroup>
        <FormGroup>
          <Label>Solicitado por:</Label>
          <Input type="text" name="solicitadopor" value={this.props.activeReport.solicitadopor} disabled />
        </FormGroup>
        <FormGroup>
          <Label>Partes / Descripcion</Label>
          <Input type="textarea" name="partesdescripcion" value={this.props.activeReport.partesdescripcion} disabled />
        </FormGroup>
        <FormGroup>
          <Label>Tareas</Label>
          <Input type="textarea" name="tareas" value={this.props.activeReport.tareas} disabled />
        </FormGroup>
        <FormGroup>
          <Label>Tipo</Label>
          <Input type="textarea" name="tipo" value={this.props.activeReport.tipo} disabled />
        </FormGroup>
        <FormGroup>
          <Label>Hora de llegada</Label>
          <Input type="time" name="horallegada" placeholder="time placeholder" value={this.props.activeReport.horallegada} disabled />
        </FormGroup>
        <FormGroup>
          <Label>Hora de salida</Label>
          <Input type="time" name="horasalida" placeholder="time placeholder" value={this.props.activeReport.horasalida} disabled />
        </FormGroup>
        <FormGroup>
          <Label>Tiempo de traslado</Label>
          <Input type="time" name="tiempotraslado" placeholder="time placeholder" value={this.props.activeReport.tiempotraslado} disabled />
        </FormGroup>
        <FormGroup>
          <Label>Fecha</Label>
          <Input type="input" name="fecha" value={this.props.activeReport.fecha} disabled />
        </FormGroup>
        <Button onClick={()=>this.onClickImprimir()}>Imprimir Reporte</Button>
      </Form>
    );
  }
}

const mapStateToProps=state=>({
  ticket:state.ticket,
  token:state.login.token
});

export default connect(mapStateToProps, {getTicket})(VerReporteForm);