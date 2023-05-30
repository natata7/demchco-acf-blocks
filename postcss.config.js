const fs = require( 'fs' );
const globalThemePreset = fs.existsSync( process.env.activePreset )
	? process.env.activePreset
	: process.env.fallbackPreset;

module.exports = {
	plugins: {
		autoprefixer: { grid: true },
		...( process.env.NODE_ENV === 'production'
			? {
					cssnano: {
						preset: [
							'default',
							{
								discardComments: {
									removeAll: true,
								},
							},
						],
					},
			  }
			: {} ),
	},
};
