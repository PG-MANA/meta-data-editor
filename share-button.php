<?php

/*
 * Copyright 2024 PG_MANA
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

return '<div>
	<a href="https://twitter.com/share?url=' . $post_url . '&text=' . $share_text . '" target="_blank" title="Share with Twitter(X)" style="margin-right: 16px;text-decoration: none;">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400" width="32">
			<rect style="fill:#1da1f2;" width="400" height="400"/>
			<path style="fill:#fff;" d="M153.62,301.59c94.34,0,145.94-78.16,145.94-145.94,0-2.22,0-4.43-.15-6.63A104.36,104.36,0,0,0,325,122.47a102.38,102.38,0,0,1-29.46,8.07,51.47,51.47,0,0,0,22.55-28.37,102.79,102.79,0,0,1-32.57,12.45,51.34,51.34,0,0,0-87.41,46.78A145.62,145.62,0,0,1,92.4,107.81a51.33,51.33,0,0,0,15.88,68.47A50.91,50.91,0,0,1,85,169.86c0,.21,0,.43,0,.65a51.31,51.31,0,0,0,41.15,50.28,51.21,51.21,0,0,1-23.16.88,51.35,51.35,0,0,0,47.92,35.62,102.92,102.92,0,0,1-63.7,22A104.41,104.41,0,0,1,75,278.55a145.21,145.21,0,0,0,78.62,23"/>
		</svg>
	</a>
	<a href="https://b.hatena.ne.jp/entry/panel/?url=' . $post_url . '&btitle=' . $share_text . '" target="_blank" title="Share with Hatena BookMark" style="margin-right: 16px;text-decoration: none;" >
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="32">
			<rect width="500" height="500" rx="101.9" ry="101.9" fill="#00a4de"/>
			<g fill="#fff" >
				<path d="M278.2,258.1q-13.6-15.2-37.8-17c14.4-3.9,24.8-9.6,31.4-17.3s9.8-17.8,9.8-30.7A55,55,0,0,0,275,166a48.8,48.8,0,0,0-19.2-18.6c-7.3-4-16-6.9-26.2-8.6s-28.1-2.4-53.7-2.4H113.6V363.6h64.2q38.7,0,55.8-2.6c11.4-1.8,20.9-4.8,28.6-8.9a52.5,52.5,0,0,0,21.9-21.4c5.1-9.2,7.7-19.9,7.7-32.1C291.8,281.7,287.3,268.2,278.2,258.1Zm-107-71.4h13.3q23.1,0,31,5.2c5.3,3.5,7.9,9.5,7.9,18s-2.9,14-8.5,17.4-16.1,5-31.4,5H171.2V186.7Zm52.8,130.3c-6.1,3.7-16.5,5.5-31.1,5.5H171.2V273h22.6c15,0,25.4,1.9,30.9,5.7s8.4,10.4,8.4,20S230.1,313.4,223.9,317.1Z"/>
				<path d="M357.6,306.1a28.8,28.8,0,1,0,28.8,28.8A28.8,28.8,0,0,0,357.6,306.1Z"/>
				<rect x="332.6" y="136.4" width="50" height="151.52"/>
			</g>
		</svg>
	</a>
	<a href="https://reddit.com/submit?url=' . $post_url . 'title=' . $share_text . '" target="_blank" title="Share with Reddit" style="margin-right: 16px;text-decoration: none;" >
		<svg xmlns=\"http://www.w3.org/2000/svg\" width="32" height="32" viewBox="0 0 341.8 341.8">
			<rect style="fill:#FF4500;" width="341.8" height="341.8"/>
			<path style="fill:#fff;" d="M227.9,170.9c0-6.9-5.6-12.5-12.5-12.5c-3.4,0-6.4,1.3-8.6,3.5c-8.5-6.1-20.3-10.1-33.3-10.6l5.7-26.7l18.5,3.9c0.2,4.7,4.1,8.5,8.9,8.5c4.9,0,8.9-4,8.9-8.9c0-4.9-4-8.9-8.9-8.9c-3.5,0-6.5,2-7.9,5l-20.7-4.4c-0.6-0.1-1.2,0-1.7,0.3c-0.5,0.3-0.8,0.8-1,1.4l-6.3,29.8c-13.3,0.4-25.2,4.3-33.8,10.6c-2.2-2.1-5.3-3.5-8.6-3.5c-6.9,0-12.5,5.6-12.5,12.5c0,5.1,3,9.4,7.4,11.4c-0.2,1.2-0.3,2.5-0.3,3.8c0,19.2,22.3,34.7,49.9,34.7s49.9-15.5,49.9-34.7c0-1.3-0.1-2.5-0.3-3.7C224.8,180.4,227.9,176,227.9,170.9z M142.4,179.8c0-4.9,4-8.9,8.9-8.9c4.9,0,8.9,4,8.9,8.9c0,4.9-4,8.9-8.9,8.9C146.4,188.7,142.4,184.7,142.4,179.8z M192.1,203.3c-6.1,6.1-17.7,6.5-21.1,6.5c-3.4,0-15.1-0.5-21.1-6.5c-0.9-0.9-0.9-2.4,0-3.3c0.9-0.9,2.4-0.9,3.3,0c3.8,3.8,12,5.2,17.9,5.2s14-1.4,17.9-5.2c0.9-0.9,2.4-0.9,3.3,0C193,201,193,202.4,192.1,203.3zM190.5,188.7c-4.9,0-8.9-4-8.9-8.9c0-4.9,4-8.9,8.9-8.9c4.9,0,8.9,4,8.9,8.9C199.4,184.7,195.4,188.7,190.5,188.7z"/>
		</svg>
	</a>
</div>';
