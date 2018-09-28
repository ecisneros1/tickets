import {GET_REPORTES, ADD_REPORTE, UPDATE_REPORTE, REPORTES_LOADING, CONFIRMACION_MODAL, REPORTES_FILTER, SET_REPORTES} from './types';
import proxy from '../../config/proxy/proxy';
import axios from 'axios';

export const getReportes=(token)=>dispatch=>{
    dispatch(setReportesLoading());
    let data=new FormData();
    data.append('mostrar','1');
    data.append('token',token);
    axios.post(proxy+'/api/reportes/administrar_reporte.php', data)
      .then(function (response) {
        // handle success
        dispatch({
            type:GET_REPORTES,
            payload:response.data
        });
        return 'getReportes: '+response.data;
      }).catch(function (error) {
        // handle error
        console.log(error);
        
        //window.location = proxy+'/error.html';
      });
};

export const updateReporte=(id)=>{
    return{
        type: UPDATE_REPORTE,
        payload: id
    };
};

export const addReporte=(reporte, token)=>dispatch=>{
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
    data.append('token',token);
    axios.post(proxy+'/api/reportes/administrar_reporte.php', data)
      .then(function (response) {
        // handle success

        getTicketById(response,token, response);
        //console.log(response.data);

            dispatch({
                type:ADD_REPORTE,
                payload:response.data
            });
    
            dispatch({
                type:CONFIRMACION_MODAL,
                payload:'Reporte creado exitosamente'
            });
        
      }).catch(function (error) {
        // handle error
        console.log(error);
        //window.location = proxy+'/error.html';
      });
};

const getTicketById=(resp, token)=>{
    let data=new FormData();
    data.append('obtener','1');
    data.append('id_ticket', resp.data.id_ticket);
    data.append('token',token);
    axios.post(proxy+'/api/tickets/administrar_ticket.php',data)
        .then(function(response){
            let respon={
                email:response.data.email,
                id_reporte:resp.data.id_reporte,
                nombre:resp.data.cliente,
                id:resp.data.id_ticket,
                fecha:resp.data.fecha,
                publictoken:resp.data.publictoken
            }
            //console.log(respon.email);
            return sendEmail(respon,token);
        }).catch(function (err){
            console.log(err);
            
            //window.location = proxy+'/error.html';
        });
};

const sendEmail=(resp, token)=>{
    let data=new FormData();
    //console.log(resp.email);
    data.append('mail','1');
    data.append('email',resp.email);
    data.append('id_reporte',resp.id_reporte);
    data.append('nombre',resp.nombre);
    data.append('id',resp.id);
    data.append('fecha',resp.fecha);
    data.append('publictoken',resp.publictoken);
    data.append('token',token);
    //console.log('holaaaaa '+resp.email);
    axios.post(proxy+'/api/email/administrar_email.php',data)
        .then(function(response){
            //console.log(response);
            //return 'sendEmail: '+response;
            return 1;
        })
        .catch(function (err){
            console.log(err);
            return 0;
            //window.location = proxy+'/error.html';
        });
};


export const resendEmail=(reporte, token)=>dispatch=>{
    let data=new FormData();
    data.append('mail','1');
    data.append('email',reporte.correo);
    data.append('id_reporte',reporte.id_reporte);
    data.append('nombre',reporte.cliente);
    data.append('id',reporte.id_ticket);
    data.append('fecha',reporte.fecha);
    data.append('token',token);
    //console.log('holaaaaa '+resp.email);
    axios.post(proxy+'/api/email/administrar_email.php',data)
        .then(function(response){
            //console.log(response);
            //return 'sendEmail: '+response;
            dispatch({
                type:CONFIRMACION_MODAL,
                payload:'Correo enviado'
            });
        })
        .catch(function (err){
            console.log(err);
            return 0;
            //window.location = proxy+'/error.html';
        });
}

export const setReportesLoading=()=>{
    return{
        type: REPORTES_LOADING
    };
};

export const setReportes=(reportes)=>dispatch=>{
    dispatch(setReportesLoading());
    dispatch({
        type: SET_REPORTES,
        payload: reportes
    });
}

export const filterReportes=(reportes, type, criteria)=>dispatch=>{

    var filtrado='';

    if(type===1){
        filtrado=reportes.filter(filterFecha(criteria));
    }else if(type===2){
        filtrado=filterCliente(reportes, criteria);
    }else if(type===3){
        filtrado=filterIdReporte(reportes,criteria);
    }else if(type===4){
        filtrado=filterIdTicket(reportes,criteria);
    }

    //console.log(filtrado);

    dispatch({
        type:REPORTES_FILTER,
        payload:filtrado
    });
}


const filterFecha=(criteria)=>{
    return function(reporte){
        return reporte.fecha.indexOf(criteria)!==-1;
    }
};

const filterCliente=(reportes,criteria)=>{
    let reps=[];
        for(let reporte of reportes){
        if(reporte.cliente.includes(criteria)){
            reps=[...reps, reporte];
        }
    }
    return reps;
};

const filterIdReporte=(reportes,criteria)=>{
    let reps=[];
        for(let reporte of reportes){
        if(reporte.id_reporte===criteria){
            reps=[...reps, reporte];
        }
    }
    return reps;
};

const filterIdTicket=(reportes,criteria)=>{
    let reps=[];
        for(let reporte of reportes){
        if(reporte.id_ticket===criteria){
            reps=[...reps, reporte];
        }
    }
    return reps;
}