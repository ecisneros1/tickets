import {combineReducers} from 'redux';
import reporteReducer from './reporteReducer';
import ticketReducer from './ticketReducer';
import loginReducer from './loginReducer';
import confirmacionReducer from './confirmacionReducer';

export default combineReducers({
    reporte:reporteReducer,
    ticket:ticketReducer,
    login:loginReducer,
    confirmacion:confirmacionReducer
});