import {LOGIN_USER, LOGIN_LOADING, LOGIN_MODAL} from '../actions/types';

const initialState={
    token:'',
    modalSt:true,
    loading:false
}


export default function(state=initialState, action){
    switch(action.type){
        case LOGIN_USER:{
            return{
                ...state,
                token:action.payload,
                modalSt:false,
                loading:false
            };
        }
        case LOGIN_MODAL:{
            return{
                ...state,
                token:'error',
                modalSt:true,
                loading:false
            };
        }
        case LOGIN_LOADING:{
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