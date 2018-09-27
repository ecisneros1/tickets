import React, {Component} from "react";
//import { makeData, Logo, Tips } from "./Utils";

// Import React Table
import ReactTable from "react-table";
import "react-table/react-table.css";
import "../styles/style.css";
import { Button, Container, Row, Col, FormGroup, Label, Input  } from 'reactstrap';
import {connect} from 'react-redux';
import {getTickets, setTickets, filterTickets} from '../appdata/actions/ticketActions';
import ReporteModal from './ReporteModal';

class TablaTickets extends Component {

  constructor() {
    super();
    this.state = {
      modal: false,
      activeTicket:{
          name:'default',
          ticketid:'default',
          phone:'default',
          email:'default'
      }
    };
    this.toggle1 = this.toggle1.bind(this);
    this.onClick=this.onClick.bind(this);
    this.onClickCargarMas=this.onClickCargarMas.bind(this);
  }

  onClick(tick){
    //console.log(tick);
    this.setState({
        activeTicket:{
            name:tick.name,
            ticketid:tick.ticketid,
            phone:tick.phone,
            email:tick.email
        }
    });
    this.toggle1();
}

toggle1(){
  this.setState({
    modal: !this.state.modal
  });
}

onClickCargarMas(){
  if(!this.state.select || this.state.select===0){
    if(!this.props.ticketTodo){
      this.props.setTickets(this.props.ticketTodo);
    }else{
      this.props.getTickets(this.props.token);
    }
  }else{
    this.props.filterTickets(this.props.ticketTodo, this.state.select, this.state.text);
  }
}


handle=(event)=>{
  switch(event.target.name){
      case 'select':{
          this.setState({
              select:event.target.selectedIndex
          });
          break;
      }

      case 'text':{
          this.setState({
              text:event.target.value
          });
          break;
      }

      default:{
        break;
      }
  }
}


  render() {
    //const { data } = this.state;
    const data=this.props.ticket;
    if(this.props.ticket){
      return (
        <div>
          <ReporteModal modal={this.state.modal} toggle={this.toggle1} activeTicket={this.state.activeTicket}></ReporteModal>
          <h1>TICKETS</h1>
          <br></br>
          <Container>
          <Row>
          <Col xs="6">
            <FormGroup>
                <Label>Seleccione un criterio de busqueda</Label>
                <Input type="select" name="select" onChange={this.handle.bind(this)}>
                    <option>Todo</option>
                    <option>Cliente</option>
                    <option>ID Ticket</option>
                </Input>
            </FormGroup>
            <FormGroup>
                <Input type="text" name="text" placeholder="Criterio de busqueda" onChange={this.handle.bind(this)} />
            </FormGroup>
           </Col>
            <Col xs="6" style={styling}>
              <Button onClick={this.onClickCargarMas} size="lg" block >Cargar más</Button>
            </Col>
            </Row>
          </Container>
          <ReactTable
            data={data}
            columns={[
              {
                columns: [
                  {
                    Header: "ID Ticket",
                    accessor: "ticketid"
                  },
                  {
                    Header: "Cliente",
                    accessor:"name"
                  },
                  {
                    Header: "Asunto",
                    accessor: "subject"
                  },
                  {
                    Header: "Creado",
                    accessor: "created"
                  },
                  {
                    Cell: row=>(
                      <Button color="primary" onClick={()=>this.onClick(data[row.index])}>Crear Reporte</Button>
                    )
                  }
                ]
              }]}
            defaultPageSize={10}
            className="-striped -highlight"
          />
        </div>
      );
    }else{
      return null;
    }
  }
}

var styling={
  "textAlign":"center",
    "verticalAlign": "middle",
    "marginTop":"30pt"
}

const mapStateToProps=(state)=>({
  ticket:state.ticket.tickets,
  ticketTodo:state.ticket.ticketsTodo,
  token:state.login.token,
  modal:state.login.modalSt
});

export default connect(mapStateToProps, {getTickets, setTickets, filterTickets})(TablaTickets);
