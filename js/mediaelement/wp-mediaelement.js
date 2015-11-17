/* global mejs, _wpmejsSettings */
(function ($) {

	// add mime-type aliases to MediaElement plugin support
	mejs.plugins.silverlight[0].types.push('video/x-ms-wmv');
	mejs.plugins.silverlight[0].types.push('audio/x-ms-wma');

	/*
	$(function () {
		var settings = {};

		if ( typeof _wpmejsSettings !== 'undefined' ) {
			settings = _wpmejsSettings;
		}

		settings.success = settings.success || function (mejs) {
			var autoplay, loop;

			if ( 'flash' === mejs.pluginType ) {
				autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
				loop = mejs.attributes.loop && 'false' !== mejs.attributes.loop;

				autoplay && mejs.addEventListener( 'canplay', function () {
					mejs.play();
				}, false );

				loop && mejs.addEventListener( 'ended', function () {
					mejs.play();
				}, false );
			}
		};

		$('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer( settings );
	});
	*/

	var player;
	var settings = _wpmejsSettings || {};
	settings.success || (settings.success = function success(mejs) {
		var autoplay;
		var loop;

		if ('flash' === mejs.pluginType) {
			autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
			loop = mejs.attributes.loop && 'false' !== mejs.attributes.loop;

			autoplay && mejs.addEventListener('canplay', function () {
				mejs.play();
			}, false);

			loop && mejs.addEventListener('ended', function () {
				mejs.play();
			}, false);
		}

		player = mejs;
	});

	$(function() {
		var playerStr = [
			'<div class="audio_player">',
				'<audio preload="none" style="width:100%;visibility:hidden;" controls="controls">',
					'<source type="audio/mpeg" src=""/>',
					'<a href="#"></a>',
				'</audio>',
			'</div>',
		].join('');

		$('footer.main')
			.append(playerStr)
			.find('audio')
			.mediaelementplayer(settings);

		$('footer.main')
			.css('height', '100px')
			.find('.audio_player')
			.css('height', 0);

		$('.audio_player > a.listen-now')
			.on('click', function onClick(event) {
				event.preventDefault();
				event.stopPropagation();

				player.pause();
				player.setSrc(event.target.href);
				player.play();

				$('footer.main')
					.css('height', '130px')
					.find('.audio_player')
					.css('height', '30px');
			});
	});

}(jQuery));
