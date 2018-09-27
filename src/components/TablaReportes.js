import React, {Component} from "react";
//import { makeData, Logo, Tips } from "./Utils";

// Import React Table
import ReactTable from "react-table";
import "react-table/react-table.css";
import "../styles/style.css";
import { Button, Container, Row, Col, FormGroup, Label, Input } from 'reactstrap';
import {connect} from 'react-redux';
import {getReportes, filterReportes, setReportes} from '../appdata/actions/reporteActions';
import VerReporteModal from './VerReporteModal';

class TablaReportes extends Component {

    constructor() {
        super();
        this.state = {
          modal: false,
          activeReport:{
            id:'',
            cliente:'',
            id_ticket:'',
            contacto:'',
            solicitadopor:'',
            partesdescripcion:'',
            tareas:'',
            tipo:'',
            horallegada:'',
            horasalida:'',
            tiempotraslado:'',
            fecha:''
          }
        };
        this.toggle1 = this.toggle1.bind(this);
        this.onClickCargarMas=this.onClickCargarMas.bind(this);
      }

      onClick(reporte){
        //console.log(reporte);
        this.setState({
          activeReport:reporte
        });
        
        this.toggle1();
      }
    
      onClickCargarMas(){
        if(!this.state.select || this.state.select===0){
          if(!this.props.reporteTodo){
            this.props.setReportes(this.props.reporteTodo);
          }else{
            this.props.getReportes(this.props.token);
          }
        }else{
          this.props.filterReportes(this.props.reporteTodo, this.state.select, this.state.text);
        }
      }
    
      toggle1(){
        this.setState({
          modal: !this.state.modal
        });
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
    const data=this.props.reporte;
    if(this.props.reporte){
      return (
        <div>
          <VerReporteModal modal={this.state.modal} toggle={this.toggle1} activeReport={this.state.activeReport}></VerReporteModal>
          <h1>REPORTES</h1>
          <br></br>
          <Container>
          <Row>
          <Col xs="6">
            <FormGroup>
                <Label>Seleccione un criterio de busqueda</Label>
                <Input type="select" name="select" onChange={this.handle.bind(this)}>
                    <option>Todo</option>
                    <option>Fecha (dd/mm/aaaa)</option>
                    <option>Cliente</option>
                    <option>ID Reporte</option>
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
                    Header: "ID Reporte",
                    accessor: "id_reporte"
                  },
                  {
                    Header: "ID Ticket",
                    accessor: "id_ticket"
                  },
                  {
                    Header: "Cliente",
                    accessor:"cliente"
                  },
                  {
                    Header: "Contacto",
                    accessor: "contacto"
                  },
                  {
                    Header: "Fecha",
                    accessor: "fecha"
                  },
                  {
                    Cell: row=>(
                      <Button color="primary" onClick={()=>this.onClick(data[row.index])}>Ver Reporte</Button>
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
  reporte:state.reporte.reportes,
  reporteTodo:state.reporte.reportesTodo,
  token:state.login.token,
  modal:state.login.modalSt
});

export default connect(mapStateToProps, {getReportes, filterReportes, setReportes})(TablaReportes);
