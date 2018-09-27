import {GET_TICKETS, GET_TICKET, TICKETS_LOADING, CLOSE_TICKET, TICKETS_FILTER, SET_TICKETS} from '../actions/types';

const initialState={
    tickets:[],
    ticketsTodo:[],
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
                ticketsTodo:action.payload,
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
        case CLOSE_TICKET:{
            return{
                ...state,
                tickets:action.payload,
                ticketsTodo:action.payload,
                loading:false
            }
        }
        case TICKETS_LOADING:{
            return{
                ...state,
                loading:true
            }
        }
        case TICKETS_FILTER:{
            return{
                ...state,
                tickets:action.payload,
                loading:false
            }
        }
        case SET_TICKETS:{
            return{
                ...state,
                tickets:action.payload,
                loading:false
            }
        }
        default:{
            return state;
        }
    }
}