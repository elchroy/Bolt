import React from 'react'

export default (props) => {
	const { video, loadPlayer } = props
	return (<div className="unit-video" onClick={loadPlayer}>
		<img className="video-thumbnail" src={`http://img.youtube.com/vi/${video.url.split("=")[1]}`} />
	</div>)
}

// export default class Video extends React.Component {

// 	render () {
// 		console.log(this.props)
// 		return (<div>

// 		</div>)
// 	}
// }