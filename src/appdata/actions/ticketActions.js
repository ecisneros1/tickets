import {GET_TICKETS, GET_TICKET, TICKETS_LOADING} from './types';
import proxy from '../../config/proxy/proxy';
import axios from 'axios';

export const getTickets=()=>dispatch=>{
    dispatch(setTicketsLoading());
    let data=new FormData();
    data.append('mostrar','1');
    axios.post(proxy+'/api/tickets/administrar_ticket.php', data)
      .then(function (response) {
        // handle success
        dispatch({
            type:GET_TICKETS,
            payload:response.data
        });
        
      }).catch(function (error) {
        // handle error
        console.log(error);
      });
};

export const getTicket=(id_ticket)=>dispatch=>{
    dispatch(setTicketsLoading());
    let data=new FormData();
    data.append('obtener','1');
    data.append('id_ticket',id_ticket)
    axios.post(proxy+'/api/tickets/administrar_ticket.php', data)
      .then(function (response) {
        // handle success
        dispatch({
            type:GET_TICKET,
            payload:response.data
        });
        
      }).catch(function (error) {
        // handle error
        console.log(error);
      });
};

export const setTicketsLoading=()=>{
    return{
        type: TICKETS_LOADING
    };
};