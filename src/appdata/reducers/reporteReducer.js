import {GET_REPORTES, ADD_REPORTE, UPDATE_REPORTE, REPORTES_LOADING} from '../actions/types';

const initialState={
    reportes:[],
    loading:false
}


export default function(state=initialState, action){
    switch(action.type){
        case GET_REPORTES:{
            return{
                ...state,
                reportes:action.payload,
                loading:false
            };
        }
        case UPDATE_REPORTE:{
            return{
                ...state,
                reportes:state.reportes.filter(reporte=>reporte.id_reporte!==action.payload)
            }
        }
        case ADD_REPORTE:{
            return{
                ...state,
                reportes:[action.payload, ...state.reportes]
            }
        }
        case REPORTES_LOADING:{
            return{
                ...state,
                loading:true
            }
        }

        default:{
            return state;
        }
    }
}