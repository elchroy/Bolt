import { createStore, compose, applyMiddleware } from 'redux';
import thunk from 'redux-thunk'
// import { composeWithDevTools } from 'redux-devtools-extension'
import { browserHistory } from 'react-router';
import { syncHistoryWithStore } from 'react-router-redux';

// Import the root reducer
import rootReducer from './reducers/index';
//create and object fro the default data.
const defaultState = {
}

const enhancers = compose(
	window.devToolsExtension ? window.devToolsExtension() : f => f
);

const store = createStore(rootReducer, defaultState, enhancers);

// export const history = syncHistoryWithStore(browserHistory, store);

export default store;