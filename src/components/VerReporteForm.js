import React, {Component} from 'react';
import { Button, Form, FormGroup, Label, Input } from 'reactstrap';
import {getTicket} from '../appdata/actions/ticketActions';
import {connect} from 'react-redux';

class VerReporteForm extends Component {

  componentDidMount(){
    this.props.getTicket(this.props.activeReport.id_ticket);
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
        <Button onClick={this.onClickAceptar}>Imprimir Reporte</Button>
      </Form>
    );
  }
}

const mapStateToProps=state=>({
  ticket:state.ticket
});

export default connect(mapStateToProps, {getTicket})(VerReporteForm);