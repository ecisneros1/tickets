import {GET_REPORTES, ADD_REPORTE, REPORTES_LOADING, REPORTES_FILTER, SET_REPORTES} from '../actions/types';

const initialState={
    reportes:[],
    reportesTodo:[],
    loading:false
}


export default function(state=initialState, action){
    switch(action.type){
        case GET_REPORTES:{
            return{
                ...state,
                reportes:action.payload,
                reportesTodo:action.payload,
                loading:false
            };
        }
        case ADD_REPORTE:{
            return{
                ...state,
                reportes:[action.payload, ...state.reportes],
                reportesTodo:[action.payload, ...state.reportesTodo]
            }
        }
        case REPORTES_LOADING:{
            return{
                ...state,
                loading:true
            }
        }
        case REPORTES_FILTER:{
            return{
                ...state,
                reportes:action.payload,
                loading:false
            }
        }
        case SET_REPORTES:{
            return{
                ...state,
                reportes:action.payload,
                loading:false
            }
        }
        default:{
            return state;
        }
    }
}