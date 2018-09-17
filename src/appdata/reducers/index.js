import {combineReducers} from 'redux';
import reporteReducer from './reporteReducer';
import ticketReducer from './ticketReducer';

export default combineReducers({
    reporte:reporteReducer,
    ticket:ticketReducer
});