import React from 'react'
import ReactDOM from 'react-dom'

import { Provider, connect } from 'react-redux';
import { ConnectedRouter as Router, routerReducer, routerMiddleware } from 'react-router-redux'
import { BrowserRouter, Route } from 'react-router-dom'
import { createStore, applyMiddleware, combineReducers, bindActionCreators } from 'redux'

import { composeWithDevTools } from 'redux-devtools-extension'

import thunk from 'redux-thunk'
import createHistory from 'history/createBrowserHistory';
const history = createHistory()
const middleware = routerMiddleware(history)
import * as actionCreators from './actions'

/**
 * Requirements
 */
// import store from './store.js'
import rootReducers from './reducers'
const store = createStore(rootReducers, composeWithDevTools(applyMiddleware(middleware, thunk)))

/**
 * Components
 */

// function mapStateToProps(state) {
// 	return {
// 		posts: state.videos
// 	}
// }

// function mapDispatchToProps(dispatch) {
// 	return bindActionCreators(actionCreators, dispatch);
// }

import Main from './components/Main.jsx'

// const App = connect(mapStateToProps, mapDispatchToProps)(Main);

const router = (
    <Provider store={store}>
		<BrowserRouter history={history}>
			<Route path='/' component={Main} />
	    </BrowserRouter>
	</Provider>
)

const app = document.getElementById("bolt");
ReactDOM.render(router, app);




