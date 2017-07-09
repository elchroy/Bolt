import React from 'react';

import VideosContainer from '../containers/VideosContainer.jsx'

export default class App extends React.Component {
	constructor(props) {
		super(props);
		this.state = {}
	}
	render () {
		return (
			<div>
				<VideosContainer />
			</div>
		)
	}
}