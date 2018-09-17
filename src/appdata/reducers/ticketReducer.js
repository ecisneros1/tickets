import {GET_TICKETS, GET_TICKET, TICKETS_LOADING} from '../actions/types';

const initialState={
    tickets:[],
    activeTicket:{
        phone:'',
        email:''
    },
    loading:false
}


export default function(state=initialState, action){
    switch(action.type){
        case GET_TICKETS:{
            return{
                ...state,
                tickets:action.payload,
                loading:false
            };
        }
        case GET_TICKET:{
            return{
                ...state,
                activeTicket:action.payload,
                loading:false
            };
        }
        case TICKETS_LOADING:{
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