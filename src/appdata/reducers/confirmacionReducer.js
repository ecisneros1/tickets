import {CONFIRMACION_MODAL,CONFIRMACION_CLOSE} from '../actions/types';

const initialState={
    modalC:false,
    messageC:''
}


export default function(state=initialState, action){
    switch(action.type){
        case CONFIRMACION_MODAL:{
            return{
                ...state,
                modalC:true,
                messageC:action.payload
            };
        }
        case CONFIRMACION_CLOSE:{
            return{
                ...state,
                modalC:false,
                messageC:action.payload
            }
        }
        default:{
            return state;
        }
    }
}