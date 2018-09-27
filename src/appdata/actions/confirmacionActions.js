import {CONFIRMACION_MODAL, CONFIRMACION_CLOSE} from './types';

export const setConfirmacion=(message)=>dispatch=>{
    dispatch({
        type:CONFIRMACION_MODAL,
        payload:'El sistema respondio: '+message
    });
};

export const closeConfirmacion=()=>dispatch=>{
    dispatch({
        type:CONFIRMACION_CLOSE,
        payload:''
    });
}