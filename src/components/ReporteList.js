import React, {Component} from 'react';
import { ListGroup, ListGroupItem, Card, CardText, CardBody,
  CardTitle, CardSubtitle, Button } from 'reactstrap';
import {connect} from 'react-redux';
import {getReportes} from '../appdata/actions/reporteActions';
import PropTypes from 'prop-types';
import VerReporteModal from './VerReporteModal';

import {
  CSSTransition,
  TransitionGroup
} from 'react-transition-group';

class ReporteList extends Component {


  constructor(props) {
    super(props);
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

  componentDidMount(){
    //this.props.getReportes(this.props.token);
  }

  onClick(reporte){
    //console.log(reporte);
    this.setState({
      activeReport:reporte
    });
    
    this.toggle1();
  }

  onClickCargarMas(){
    this.props.getReportes(this.props.token);
  }

  toggle1(){
    this.setState({
      modal: !this.state.modal
    });
  }


  render() {
        const{reportes}=this.props.reporte;
        return (
          <div>
          <VerReporteModal modal={this.state.modal} toggle={this.toggle1} activeReport={this.state.activeReport}></VerReporteModal>
          <ListGroup>
            <TransitionGroup className="lista">
              {Object.keys(reportes).map((item, i) => (
                <CSSTransition key={reportes[item].id_reporte} timeout={500} classNames="fade">
                  <ListGroupItem>
                    <div className='container'>
                      <Card>
                        <CardBody>
                          <CardTitle>ID Ticket: {reportes[item].id_ticket} &nbsp;&nbsp; Cliente: {reportes[item].cliente}</CardTitle>
                          <CardSubtitle>Contacto: {reportes[item].contacto}</CardSubtitle>
                          <CardText>Fecha: {reportes[item].fecha}</CardText>
                          <Button color="primary" onClick={() => this.onClick(reportes[item])}>Ver Reporte</Button>
                        </CardBody>
                      </Card>
                    </div>
                  </ListGroupItem>
                </CSSTransition>
              ))}
            </TransitionGroup>
            <br/>
              <br/>
            <Button onClick={this.onClickCargarMas}>Cargar más</Button>
          </ListGroup>
          </div>
        );
  }
}

ReporteList.propTypes={
  getReportes:PropTypes.func.isRequired,
  reporte:PropTypes.object.isRequired
}

const mapStateToProps=(state)=>({
  reporte:state.reporte,
  token:state.login.token,
  modal:state.login.modal
});

export default connect(mapStateToProps, {getReportes})(ReporteList);