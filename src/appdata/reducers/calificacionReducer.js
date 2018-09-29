import {GET_CALIFICACION, CALIFICACION_LOADING, SET_CALIFICACION_EMPTY} from '../actions/types';

const initialState={
    activecalificacion:{
        servicio:'',
        puntualidad:'',
        observaciones:''
    },
    loading:false
}


export default function(state=initialState, action){
    switch(action.type){
        case GET_CALIFICACION:{
            return{
                ...state,
                activecalificacion:action.payload,
                loading:false
            };
        }
        case CALIFICACION_LOADING:{
            return{
                ...state,
                loading:true
            }
        }
        case SET_CALIFICACION_EMPTY:{
            return{
                ...state,
                activecalificacion:action.payload,
                loading:false
            }
        }
        default:{
            return state;
        }
    }
}