import {GET_REPORTES, ADD_REPORTE, UPDATE_REPORTE, REPORTES_LOADING, GET_TICKET} from './types';
import proxy from '../../config/proxy/proxy';
import axios from 'axios';

export const getReportes=()=>dispatch=>{
    dispatch(setReportesLoading());
    let data=new FormData();
    data.append('mostrar','1');
    axios.post(proxy+'/api/reportes/administrar_reporte.php', data)
      .then(function (response) {
        // handle success
        dispatch({
            type:GET_REPORTES,
            payload:response.data
        })
      }).catch(function (error) {
        // handle error
        console.log(error);
      });
};

export const updateReporte=(id)=>{
    return{
        type: UPDATE_REPORTE,
        payload: id
    };
};

export const addReporte=(reporte)=>dispatch=>{
    //console.log(reporte.id_cliente);
    let data=new FormData();
    data.append('insertar','1');
    data.append('cliente',reporte.cliente);
    data.append('id_ticket',reporte.id_ticket);
    data.append('contacto',reporte.contacto);
    data.append('solicitadopor',reporte.solicitadopor);
    data.append('partesdescripcion',reporte.partesdescripcion);
    data.append('tareas',reporte.tareas);
    data.append('tipo',reporte.tipo);
    data.append('horallegada',reporte.horallegada);
    data.append('horasalida',reporte.horasalida);
    data.append('tiempotraslado',reporte.tiempotraslado);
    data.append('fecha',reporte.fecha);
    axios.post(proxy+'/api/reportes/administrar_reporte.php', data)
      .then(function (response) {
        // handle success

        getTicketById(response);
        
        
        dispatch({
            type:ADD_REPORTE,
            payload:response.data
        });
        //console.log(response);
      }).catch(function (error) {
        // handle error
        console.log(error);
      });
};


const getTicketById=(resp)=>{
    let data=new FormData();
    data.append('obtener','1');
    data.append('id_ticket', resp.data.id_ticket);
    axios.post(proxy+'/api/tickets/administrar_ticket.php',data)
        .then(function(response){
            let respon={
                email:response.data.email,
                id_reporte:resp.data.id_reporte,
                nombre:resp.data.cliente,
                id:resp.data.id_ticket,
                fecha:resp.data.fecha,
            }
            //console.log(respon);
            sendEmail(respon);
        }).catch(function (err){
            console.log(err);
        });
};



const sendEmail=(resp)=>{
    let data=new FormData();
    data.append('mail','1');
    data.append('email',resp.email);
    data.append('id_reporte',resp.id_reporte);
    data.append('nombre',resp.nombre);
    data.append('id',resp.id);
    data.append('fecha',resp.fecha);
    //console.log('response= email: '+resp.email+' id_reporte: '+resp.id_reporte+' nombre: '+resp.cliente+' id: '+resp.id_ticket+' fecha: '+resp.fecha);
    axios.post(proxy+'/api/email/administrar_email.php',data)
        .catch(function (err){
            console.log(err);
        });
};




export const setReportesLoading=()=>{
    return{
        type: REPORTES_LOADING
    };
};