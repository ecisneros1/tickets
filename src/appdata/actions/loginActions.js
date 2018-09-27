import {LOGIN_USER, LOGIN_LOADING, LOGIN_MODAL} from './types';
import proxy from '../../config/proxy/proxy';
import axios from 'axios';

export const loginUser=(username, password)=>dispatch=>{
    dispatch(setLoginLoading());
    let data=new FormData();
    data.append('login','1');
    data.append('username',username);
    data.append('password',password);
    axios.post(proxy+'/api/login.php', data)
      .then(function (response) {
        // handle success
        if(response.data){
            dispatch({
                type:LOGIN_USER,
                payload:response.data
            });
            //console.log(response.data);
        }else{
            dispatch({
                type:LOGIN_MODAL
            });
        }
      }).catch(function (error) {
        // handle error
        console.log(error);
        //window.location = proxy+'/error.html';
      });
};

export const useToken=(tok)=>dispatch=>{
    dispatch(setLoginLoading());
    let data=new FormData();
    data.append('use','1');
    data.append('token',tok);
    axios.post(proxy+'/api/login.php', data)
      .then(function (response) {
        // handle success
        if(response.data!=='error'){
            dispatch({
                type:LOGIN_USER,
                payload:response.data
            });
        }else{
            dispatch({
                type:LOGIN_MODAL
            });
        }
      }).catch(function (error) {
        // handle error
        console.log(error);
        //window.location = proxy+'/error.html';
      });
};
  

/*export const addReporte=(username, password)=>dispatch=>{
    //console.log(reporte.id_cliente);
    let data=new FormData();
    data.append('insertar','1');
    data.append('username',username);
    data.append('password',password);
    axios.post(proxy+'/api/login.php', data)
      .then(function (response) {
        // handle success

        getTicketById(response);
        //console.log(response);
        
        dispatch({
            type: 'LOGIN_ADD',
            payload:response.data
        });
        //console.log(response);
      }).catch(function (error) {
        // handle error
        console.log(error);
        //window.location = proxy+'/error.html';
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
    axios.post(proxy+'/api/email/administrar_email.php',data)
        .then(function(response){
            console.log(response);
        })
        .catch(function (err){
            console.log(err);
            //window.location = proxy+'/error.html';
        });
};*/


export const setLoginLoading=()=>{
    return{
        type: LOGIN_LOADING
    };
};