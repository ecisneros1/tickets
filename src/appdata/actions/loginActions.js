import {LOGIN_USER, LOGIN_LOADING, LOGIN_MODAL} from './types';
import proxy from '../../config/proxy/proxy';
import axios from 'axios';

export const loginUser=(username, password)=>dispatch=>{
    dispatch(setLoginLoading());
    let data=new FormData();
    data.append('loginGen','1');
    data.append('login','1');
    data.append('username',username);
    data.append('password',password);
    axios.post(proxy+'index.php', data)
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
    data.append('loginGen','1');
    data.append('use','1');
    data.append('token',tok);
    axios.post(proxy+'index.php', data)
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

export const setLoginLoading=()=>{
    return{
        type: LOGIN_LOADING
    };
};