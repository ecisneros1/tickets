import {GET_TICKETS, GET_TICKET, TICKETS_LOADING, CLOSE_TICKET, CONFIRMACION_MODAL, SET_TICKETS, TICKETS_FILTER} from './types';
import proxy from '../../config/proxy/proxy';
import axios from 'axios';

export const getTickets=(token)=>dispatch=>{
    dispatch(setTicketsLoading());
    let data=new FormData();
    data.append('ticket','1');
    data.append('mostrar','1');
    data.append('token',token);
    axios.post(proxy+'index.php', data)
      .then(function (response) {
        // handle success
        console.log(response.data);
        dispatch({
            type:GET_TICKETS,
            payload:response.data
        });
        
        return 'getTickets: '+response.data;
      }).catch(function (error) {
        // handle error
        console.log(error);
        
        //window.location.reload();
        //window.location = proxy+'/error.html';
      });
};

export const getTicket=(id_ticket, token)=>dispatch=>{
    dispatch(setTicketsLoading());
    let data=new FormData();
    data.append('ticket','1');
    data.append('obtener','1');
    data.append('id_ticket',id_ticket);
    data.append('token',token);
    axios.post(proxy+'index.php', data)
      .then(function (response) {
        // handle success
        dispatch({
            type:GET_TICKET,
            payload:response.data
        });
        //return 'getTicket: '+response.data;
      }).catch(function (error) {
        // handle error
        console.log(error);
       
        //window.location = proxy+'/error.html';
      });
};

export const closeTicket=(id, token)=>dispatch=>{
  dispatch(setTicketsLoading());
  let data=new FormData();
  data.append('ticket','1');
  data.append('close','1');
  data.append('id_ticket',id);
  data.append('token',token);
  axios.post(proxy+'index.php', data)
      .then(function (response) {
        // handle success
        dispatch({
            type:CLOSE_TICKET,
            payload:response.data
        });
        dispatch({
          type:CONFIRMACION_MODAL,
          payload:'Ticket cerrado exitosamente'
        });
        //console.log('closeTicket: '+response.data);
        return 'Ticket Cerrado con exito';
      }).catch(function (error) {
        // handle error
        console.log(error);
        
        //window.location = proxy+'/error.html';
      });

};

export const setTicketsLoading=()=>{
    return{
        type: TICKETS_LOADING
    };
};


export const setTickets=(tickets)=>dispatch=>{
  dispatch(setTicketsLoading());
  dispatch({
      type: SET_TICKETS,
      payload: tickets
  });
}


export const filterTickets=(tickets, type, criteria)=>dispatch=>{

  var filtrado='';

  if(type===1){
    filtrado=filterCliente(tickets, criteria);
  }else if(type===2){
    filtrado=filterIdTicket(tickets,criteria);
  }

  //console.log(filtrado);

  dispatch({
      type:TICKETS_FILTER,
      payload:filtrado
  });
}

const filterCliente=(tickets,criteria)=>{
  let ticks=[];
      for(let ticket of tickets){
      if(ticket.name.includes(criteria)){
          ticks=[...ticks, ticket];
      }
  }
  return ticks;
};

const filterIdTicket=(tickets,criteria)=>{
  let ticks=[];
      for(let ticket of tickets){
      if(ticket.ticketid===criteria){
          ticks=[...ticks, ticket];
      }
  }
  return ticks;
}