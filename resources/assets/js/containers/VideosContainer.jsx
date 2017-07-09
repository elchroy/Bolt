import React from 'react'
import Video from '../components/Video.jsx'
import { connect } from 'react-redux'
import axios from 'axios'

import actions from '../actions'
const { videoActions } = actions

class VideosContainer extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			videos: [],
			showPlayer: false
		}
		props.getVideos();
	}

	componentWillReceiveProps(nextProps) {
		this.setState({
			videos: nextProps.videos
		})
	}
	loadPlayer (url) {
		console.log(url, "url")

	}
	render() {
		const videos = this.state.videos.map( video => <Video loadPlayer={this.loadPlayer.bind(null, video.url)} video={video} key={video.id} />)
		return (
			<div>
				{ videos }
			</div>
		)
	}
}

export default connect(state => {
	return {
		videos: state.videos
	}
}, dispatch => {
	return {
		getVideos () {
			axios
			.get('http://localhost:8888/api/v1/videos')
			.then( d => dispatch({
				type: videoActions.gottenVideos,
				videos: d.data.data
			}))
			.catch()
		}
	}
})(VideosContainer)