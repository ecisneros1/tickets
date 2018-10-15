import {GET_CALIFICACION, CALIFICACION_LOADING, SET_CALIFICACION_EMPTY} from './types';
import proxy from '../../config/proxy/proxy';
import axios from 'axios';

export const getCalificacion=(id, token)=>dispatch=>{
    dispatch(setCalificacionLoading());
    let data=new FormData();
    data.append('calificacion','1');
    data.append('getid','1');
    data.append('id',id);
    data.append('token',token);
    //console.log(id+'  '+token);
    axios.post(proxy+'index.php', data)
      .then(function (response) {
        dispatch(setCalificacionLoading());
        // handle success
            dispatch({
                type:GET_CALIFICACION,
                payload:response.data
            });
            //console.log(response.data);
      }).catch(function (error) {
        // handle error
        console.log(error);
        //window.location = proxy+'/error.html';
      });
};

export const setCalificacionEmpty=()=>dispatch=>{
    dispatch(setCalificacionLoading());
    let calificacion={
        servicio:'',
        puntualidad:'',
        observaciones:''
    }
    dispatch({
        type:SET_CALIFICACION_EMPTY,
        payload:calificacion
    });
}

export const setCalificacionLoading=()=>{
    return{
        type: CALIFICACION_LOADING
    };
};