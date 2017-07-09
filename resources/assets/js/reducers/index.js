import { combineReducers } from 'redux';
import { routerReducer } from 'react-router-redux';
import actions from '../actions'

const { videoActions } = actions

const videos = (state=[], action) => {
	switch (action.type) {
		case videoActions.gottenVideos:
			return action.videos
		default:
			return state
	}
}

const rootReducer = combineReducers({
	router: routerReducer,
	videos
})

export default rootReducer;