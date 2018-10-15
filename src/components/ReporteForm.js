import React, {Component} from 'react';
import { Button, Form, FormGroup, Label, Input, CustomInput } from 'reactstrap';
import {connect} from 'react-redux';
import {addReporte} from '../appdata/actions/reporteActions';
import {closeTicket} from '../appdata/actions/ticketActions';
import {setConfirmacion} from '../appdata/actions/confirmacionActions';

class ReporteForm extends Component {

  state={
      cliente:this.props.activeTicket.name,
      ticket:this.props.activeTicket.ticketid,
      contacto:'',
      solicitadopor:'',
      telefono:this.props.activeTicket.phone,
      correo:this.props.activeTicket.email,
      partesdescripcion:'',
      tareas:'',
      tipo:'',
      horallegada:'',
      horasalida:'',
      tiempotraslado:'',
      fecha:new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate(),
      tip1:'',
      tip2:'',
      tip3:'',
      modal:false
  }

    handle=(event)=>{
        switch(event.target.name){
            case 'cliente':{
                this.setState({cliente:event.target.value});
                break;
            }
            case 'ticket':{
              this.setState({ticket:event.target.value});
              break;
            }
            case 'contacto':{
              this.setState({contacto:event.target.value});
              break;
            }
            case 'solicitadopor':{
              this.setState({solicitadopor:event.target.value});
              break;
            }
            case 'partesdescripcion':{
              this.setState({partesdescripcion:event.target.value});
              break;
            }
            case 'tareas':{
              this.setState({tareas:event.target.value});
              break;
            }
            case 'tipo':{
              
              if(event.target.checked===true && event.target.value==='1'){
                // eslint-disable-next-line
                this.state.tip1=event.target.id;
              }else if(event.target.checked===false && event.target.value==='1'){
                // eslint-disable-next-line
                this.state.tip1='';
              }
              
              if(event.target.checked===true && event.target.value==='2'){
                // eslint-disable-next-line
                this.state.tip2=event.target.id;
              }else if(event.target.checked===false && event.target.value==='2'){
                // eslint-disable-next-line
                this.state.tip2='';
              }

              if(event.target.checked===true && event.target.value==='3'){
                // eslint-disable-next-line
                this.state.tip3=event.target.id;
              }else if(event.target.checked===false && event.target.value==='3'){
                // eslint-disable-next-line
                this.state.tip3='';
              }
              //console.log(this.state.tip1+' '+this.state.tip2+' '+this.state.tip3);
              this.setState({tipo:this.state.tip1+','+this.state.tip2+','+this.state.tip3});
              //console.log(this.state.tipo);
              break;
            }
            case 'horallegada':{
              this.setState({horallegada:event.target.value});
              break;
            }
            case 'horasalida':{
              this.setState({horasalida:event.target.value});
              break;
            }
            case 'tiempotraslado':{
              this.setState({tiempotraslado:event.target.value});
              break;
            }
            case 'fecha':{
              this.setState({fecha:event.target.value});
              break;
            }

            default:{
              break;
            }
        }
    }


    onClickAceptar=(e)=>{
      e.preventDefault();
      
      const newReporte={
        cliente:this.state.cliente,
        id_ticket:this.state.ticket,
        contacto:this.state.contacto,
        solicitadopor:this.state.solicitadopor,
        partesdescripcion:this.state.partesdescripcion,
        tareas:this.state.tareas,
        tipo:this.state.tipo,
        horallegada:this.state.horallegada,
        horasalida:this.state.horasalida,
        tiempotraslado:this.state.tiempotraslado,
        fecha:this.state.fecha,
        email:this.props.activeTicket.email
      }
      this.props.setConfirmacion(this.props.addReporte(newReporte, this.props.token));
      this.props.toggle();
    }


    onClickCerrar=()=>{  
      const id=this.state.ticket
      this.props.closeTicket(id, this.props.token);
      this.props.toggle();
    }

  render() {
    return (
      <Form>
        <FormGroup>
          <Label>Cliente</Label>
          <Input type="text" name="cliente" onChange={this.handle.bind(this)} value={this.props.activeTicket.name} disabled/>
        </FormGroup>
        <FormGroup>
          <Label>ID Ticket</Label>
          <Input type="text" name="ticket" onChange={this.handle.bind(this)} value={this.props.activeTicket.ticketid} disabled/>
        </FormGroup>
        <FormGroup>
          <Label>Contacto</Label>
          <Input type="text" name="contacto" onChange={this.handle.bind(this)} />
        </FormGroup>
        <FormGroup>
          <Label>Solicitado por:</Label>
          <Input type="text" name="solicitadopor" onChange={this.handle.bind(this)} />
        </FormGroup>
        <FormGroup>
          <Label>Teléfono</Label>
          <Input type="text" name="telefono" onChange={this.handle.bind(this)} value={this.props.activeTicket.phone} disabled/>
        </FormGroup>
        <FormGroup>
          <Label>Correo</Label>
          <Input type="text" name="correo" onChange={this.handle.bind(this)} value={this.props.activeTicket.email} disabled/>
        </FormGroup>
        <FormGroup>
          <Label>Partes / Descripcion</Label>
          <Input type="textarea" name="partesdescripcion" onChange={this.handle.bind(this)} />
        </FormGroup>
        <FormGroup>
          <Label>Tareas</Label>
          <Input type="textarea" name="tareas" onChange={this.handle.bind(this)} />
        </FormGroup>
        <FormGroup>
          <Label>Tipo</Label>
          <div>
            <CustomInput type="checkbox" name="tipo" value='1' id="instalacion" label="Instalación" onChange={this.handle.bind(this)}/>
            <CustomInput type="checkbox" name="tipo" value='2' id="soporte" label="Soporte" onChange={this.handle.bind(this)} />
            <CustomInput type="checkbox" name="tipo" value='3' id="otro" label="Otro" onChange={this.handle.bind(this)}/>
          </div>
        </FormGroup>
        <FormGroup>
          <Label>Hora de llegada</Label>
          <Input type="time" name="horallegada" placeholder="time placeholder" onChange={this.handle.bind(this)}/>
        </FormGroup>
        <FormGroup>
          <Label>Hora de salida</Label>
          <Input type="time" name="horasalida" placeholder="time placeholder" onChange={this.handle.bind(this)}/>
        </FormGroup>
        <FormGroup>
          <Label>Tiempo de traslado</Label>
          <Input type="time" name="tiempotraslado" placeholder="time placeholder" onChange={this.handle.bind(this)}/>
        </FormGroup>
        <FormGroup>
          <Label>Fecha</Label>
          <Input type="input" name="fecha" onChange={this.handle.bind(this)} value={new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate()} disabled/>
        </FormGroup>
        <Button onClick={this.onClickAceptar} color='success'>Aceptar</Button><br/><br/><br/><br/>
        <Button onClick={()=>this.onClickCerrar()} color='warning'>Cerrar Ticket</Button>
      </Form>
    );
  }
}

const mapStateToProps=state=>({
  reporte:state.reporte,
  token:state.login.token,
  modalC:state.confirmacion.modalC,
  messageC:state.confirmacion.messageC
});

export default connect(mapStateToProps, {addReporte, closeTicket, setConfirmacion})(ReporteForm);