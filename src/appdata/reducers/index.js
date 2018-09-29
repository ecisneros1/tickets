import {combineReducers} from 'redux';
import reporteReducer from './reporteReducer';
import ticketReducer from './ticketReducer';
import loginReducer from './loginReducer';
import confirmacionReducer from './confirmacionReducer';
import calificacionReducer from './calificacionReducer';

export default combineReducers({
    reporte:reporteReducer,
    ticket:ticketReducer,
    login:loginReducer,
    confirmacion:confirmacionReducer,
    calificacion:calificacionReducer
});